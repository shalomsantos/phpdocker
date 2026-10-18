<?

namespace App\Services;

use App\Models\Usuario;
use InvalidArgumentException;
use DomainException;

class UserService
{
    public function __construct(
        private Usuario $usuario
    ) {
    }

    public function all(): array
    {
        return $this->usuario->all();
    }

    public function find(int|string $id): array
    {
        $usuario = $this->usuario->find($id);

        if ($usuario === null) {
            throw new DomainException('Usuário não encontrado.');
        }

        return $usuario;
    }

    public function findByEmail(string $email): ?array
    {
        return $this->usuario->findByEmail($email);
    }

    public function create(array $data): string
    {
        $name     = trim($data['nome'] ?? '');
        $email    = trim($data['email'] ?? '');
        $password = $data['senha'] ?? '';

        if ($name === '' || $email === '' || $password === '') {
            throw new InvalidArgumentException(
                'Nome, e-mail e senha são obrigatórios.'
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail inválido.');
        }

        if ($this->usuario->emailExists($email)) {
            throw new DomainException('E-mail já cadastrado.');
        }

        return $this->usuario->create([
            'nome' => $name,
            'email' => $email,
            'senha' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function update(int|string $id, array $data): bool
    {
        $usuario = $this->usuario->find($id);

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

            $existingUser = $this->usuario->findByEmail($updateData['email']);

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

        return $this->usuario->update($id, $updateData);
    }

    public function updatePassword(int|string $id, string $password): bool 
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException(
                'A senha deve possuir pelo menos 8 caracteres.'
            );
        }

        if ($this->usuario->find($id) === false) {
            throw new DomainException('Usuário não encontrado.');
        }

        return $this->usuario->update($id, [
            'senha' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function delete(int|string $id): bool
    {
        if ($this->usuario->find($id) === false) {
            throw new DomainException('Usuário não encontrado.');
        }

        return $this->usuario->delete($id);
    }

    public function authenticate(string $email, string $password): array|false 
    {
        $usuario = $this->usuario->findByEmail($email);

        if ($usuario === false || !password_verify($password, $usuario['senha'])) {
            return false;
        }

        unset($usuario['senha']);

        return $usuario;
    }

    public function emailExists(string $email): bool
    {
        return $this->usuario->emailExists($email);
    }

    public function getTable(): string
    {
        return $this->usuario->getTable();
    }
}
