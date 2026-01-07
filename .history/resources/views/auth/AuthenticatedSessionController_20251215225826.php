namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // <--- Pastikan file ini ADA
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    // Jika Anda menggunakan LoginRequest, pastikan file tersebut sudah dibuat
    public function store(LoginRequest $request) 
    {
        // ...
    }
}