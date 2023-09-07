<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\ChMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->hasRole('Admin')){
                if(!Hash::check($request->password, $user->password)){
                    return redirect()->back()->with(['error' => 'Invalid Password!']);
                } elseif(Hash::check($request->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->route('admin.dashboard');
                }
            } else {
                return redirect()->back()->with(['error' => 'You do not have the required permissions']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Please enter valid email address']);
        }
    }

    public function dashboard()
    {
        $usersCount = User::where('email', '<>', 'admin@sahoulat.com')->count();
        $usersWithSellerRole = $this->userWithRole('seller');
        $usersWithBuyerRole = $this->userWithRole('buyer');
        $ordersCount = UserOrder::count();
        $activeOrderCount = UserOrder::where('status', 'active')->where('is_completed', '0')->count();
        $pendingOrderCount = UserOrder::where('status', 'inactive')->count();
        $totalAmount = UserOrder::sum('amount');
        return view('admin.dashboard', compact('usersCount', 'usersWithSellerRole', 
            'usersWithBuyerRole', 'ordersCount', 'activeOrderCount', 'pendingOrderCount', 'totalAmount'));
    }

    private function userWithRole($role)
    {
        $role = Role::where('name', $role)->first();
        $usersWithRole = User::whereHas('roles', function ($query) use ($role) {
            $query->where('id', $role->id);
        })->count();
        return $usersWithRole;
    }

    public function usersList()
    {
        $users = User::where('email', '<>', 'admin@sahoulat.com')->get();
        return view('admin.users', compact('users'));
    }

    public function deactivateUser($id)
    {
        $user = User::where('id', $id)->first();
        if($user){
            $user->update([
                'is_deactive' => 1,
            ]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    }

    public function activateUser($id)
    {
        $user = User::where('id', $id)->first();
        if($user){
            $user->update([
                'is_deactive' => 0,
            ]);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
    }

    public function usersChat()
    {
        $chats = ChMessage::paginate(15);
        return view('admin.users-chat', compact('chats'));
    }

    public function usersOrders()
    {
        $orders = UserOrder::all();
        return view('admin.orders', compact('orders'));
    }
}
