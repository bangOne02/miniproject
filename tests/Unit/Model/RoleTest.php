<?php

namespace Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Role;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function testRoleTableName()
    {
        $role = new Role();
        $this->assertEquals('roles', $role->getTable());
    }

    public function testRoleGuardedAttribute()
    {
        $role = new Role();
        $this->assertEquals(['name'], $role->getGuarded());
    }

    public function testKaryawanScope()
    {
        // Create test roles
        Role::create(['id' => 1, 'name' => 'Admin']);
        Role::create(['id' => 2, 'name' => 'Manager']);
        Role::create(['id' => 3, 'name' => 'Karyawan1']);
        Role::create(['id' => 4, 'name' => 'Supervisor']);
        Role::create(['id' => 5, 'name' => 'Karyawan2']);
        Role::create(['id' => 6, 'name' => 'Owner']);
        Role::create(['id' => 7, 'name' => 'Karyawan3']);

        $karyawanRoles = Role::karyawan()->get();

        $this->assertCount(3, $karyawanRoles);
        $this->assertTrue($karyawanRoles->contains('name', 'Karyawan1'));
        $this->assertTrue($karyawanRoles->contains('name', 'Karyawan2'));
        $this->assertTrue($karyawanRoles->contains('name', 'Karyawan3'));
        $this->assertFalse($karyawanRoles->contains('name', 'Admin'));
        $this->assertFalse($karyawanRoles->contains('name', 'Manager'));
        $this->assertFalse($karyawanRoles->contains('name', 'Supervisor'));
        $this->assertFalse($karyawanRoles->contains('name', 'Owner'));
    }

}
