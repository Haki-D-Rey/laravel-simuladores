<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Helpers\Roles;

class UserPolicy
{

    protected $myHelper;

    public function __construct(Roles $myHelper)
    {
        $this->myHelper = $myHelper;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['list user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['view user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['create user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['edit user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['delete user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['restore user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['forcedelete user'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }
}
