<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TareasTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_crear_tarea() {
        $response = $this->postJson('/api/tareas', [
            'titulo' => 'Tarea de prueba',
            'cuerpo' => 'Descripción...'
        ]);

        $response->assertStatus(201)
             ->assertJson(['titulo' => 'Tarea de prueba']);
    }
}
