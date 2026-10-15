<?
namespace App\Services;

use App\Models\Usuario;

class UserService
{
    function all()
    {
        return Usuario::all();
    }

    function find(string $id)
    {
        return Usuario::find($id);
    }
}