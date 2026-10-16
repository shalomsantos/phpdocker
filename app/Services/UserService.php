<?

namespace App\Services;

use App\Models\Usuario;
use InvalidArgumentException;
use DomainException;

class UserService
{
    public function all(): array
    {
        return Usuario::all();
    }

    public function find(int|string $id): array
    {
        $usuario = Usuario::find($id);

        if ($usuario === null) {
            throw new DomainException('Usuário não encontrado.');
        }

        return $usuario;
    }

    public function findByEmail(string $email): array|false
    {
        return Usuario::findByEmail($email);
    }

    public function create(array $data): string
    {
        $name = trim($data['nome'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['senha'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            throw new InvalidArgumentException(
                'Nome, e-mail e senha são obrigatórios.'
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail inválido.');
        }

        if (Usuario::emailExists($email)) {
            throw new DomainException('E-mail já cadastrado.');
        }

        return Usuario::create([
            'nome' => $name,
            'email' => $email,
            'senha' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function update(int|string $id, array $data): bool
    {
        $usuario = Usuario::find($id);

        if ($usuario === false) {
            throw new DomainException('Usuário não encontrado.');
        }

        $allowedFields = ['nome', 'email'];
        $updateData = array_intersect_key(
            $data,
            array_flip($allowedFields)
        );

        if (isset($updateData['nome'])) {
            $updateData['nome'] = trim($updateData['nome']);

            if ($updateData['nome'] === '') {
                throw new InvalidArgumentException(
                    'O nome não pode ser vazio.'
                );
            }
        }

        if (isset($updateData['email'])) {
            $updateData['email'] = trim($updateData['email']);

            if (!filter_var($updateData['email'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException('E-mail inválido.');
            }

            $existingUser = Usuario::findByEmail($updateData['email']);

            if (
                $existingUser !== false
                && (string) $existingUser['id'] !== (string) $id
            ) {
                throw new DomainException('E-mail já cadastrado.');
            }
        }

        if (empty($updateData)) {
            throw new InvalidArgumentException(
                'Nenhum campo válido para atualização.'
            );
        }

        return Usuario::update($id, $updateData);
    }

    public function updatePassword(int|string $id, string $password): bool 
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException(
                'A senha deve possuir pelo menos 8 caracteres.'
            );
        }

        if (Usuario::find($id) === false) {
            throw new DomainException('Usuário não encontrado.');
        }

        return Usuario::update($id, [
            'senha' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function delete(int|string $id): bool
    {
        if (Usuario::find($id) === false) {
            throw new DomainException('Usuário não encontrado.');
        }

        return Usuario::delete($id);
    }

    public function authenticate(string $email, string $password): array|false 
    {
        $usuario = Usuario::findByEmail($email);

        if ($usuario === false || !password_verify($password, $usuario['senha'])) {
            return false;
        }

        unset($usuario['senha']);

        return $usuario;
    }
}
