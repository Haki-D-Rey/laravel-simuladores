<?php

namespace App\Policies;

use App\Helpers\Roles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
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
            'Permisos' => ['list role'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['view role'],
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
            'Permisos' => ['create role'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['edit role'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['delete role'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['restore role'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        // Uso de la función
        $permisosRoles = [
            'Roles' => ['User', 'Admin'],
            'Permisos' => ['forcedelete role'],
        ];
        return $this->myHelper->verifyPermissionRole($permisosRoles, $user);
    }
}
