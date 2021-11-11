<?php
require_once(__DIR__.'/Calculadora.php');
use \PHPUnit\Framework\TestCase;
class CalculadoraTest extends TestCase{

    public function sumarProveedor()
    {
   return [
       'Caso 1' => [-1, -1, -2],
       'Caso 2' => [0, 0, 0],
       'Caso 3' => [0, -1, -1],
       'Caso 4' => [-1, 0, -1]
    ];
    }

    /**
    * @dataProvider sumarProveedor
    */
    public function testSumar($numero1, $numero2, $resultado_esperado)
    {
        $calculadora = new Calculadora();
        $this->assertEquals($resultado_esperado, $calculadora->sumar($numero1, $numero2));
    }

    public function restarProveedor()
    {
   return [
       'Caso 1' => [5, 3, 2],
       'Caso 2' => [4, 1, 3],
       'Caso 3' => [8, 2, 6],
       'Caso 4' => [7, 4, 3]
    ];
    }

    /**
    * @dataProvider restarProveedor
    */

    public function testRestar($numero1, $numero2, $resultado_esperado)
    {
        $calculadora = new Calculadora();
        $this->assertEquals($resultado_esperado, $calculadora->restar($numero1, $numero2));
    }

    public function multiplicarProveedor()
    {
   return [
       'Caso 1' => [3, 3, 9],
       'Caso 2' => [2, 4, 8],
       'Caso 3' => [5, 7, 35],
       'Caso 4' => [15, 2, 30]
    ];
    }

    /**
    * @dataProvider multiplicarProveedor
    */

    public function testMultiplicar($numero1, $numero2, $resultado_esperado)
    {
        $calculadora = new Calculadora();
        $this->assertEquals($resultado_esperado, $calculadora->multiplicar($numero1, $numero2));
    }

    public function dividirProveedor()
    {
   return [
       'Caso 1' => [5, 10, 0.5, 0.03],
       'Caso 2' => [0, 0, "Exeption", ""],
       'Caso 3' => [12, 3, 4, 0],
       'Caso 4' => [14, 2, 7, 0]
    ];
    }

    /**
    * @dataProvider dividirProveedor
    */

    public function testDividir($numero1, $numero2, $resultado_esperado, $delta)
    {
        $calculadora = new Calculadora();
        if($numero2 != 0){
            $this->assertEqualsWithDelta($resultado_esperado, $calculadora->dividir($numero1, $numero2), $delta);
        }else{
            $this->expectException('Exception');
            $calculadora->dividir($numero1, $numero2);
        }
        //$this->assertEqualsWithDelta(0.33, $calculadora->dividir(1, 3), 0.03);
    }

    public function testGenerarArreglo()
    {
        $calculadora = new Calculadora();
        $this->assertNotEmpty($calculadora->GenerarArreglo());
    }

    public function testCapturarEntradasPermutacion()
    {
      // Se crea el doble de prueba para la clase Calculadora, método 'capturarEntradasPermutacion'
      $stub = $this->createMock('Calculadora');
      $stub->method('capturarEntradasPermutacion')->willReturn(array(5, 3));

      $this->assertSame(array(5, 3), $stub->capturarEntradasPermutacion());

    }

    public function testCalcularPermutacion()
    {
        $mock = $this->getMockBuilder('Calculadora')
            ->onlyMethods(array('calcularFactorial'))
            ->getMock();

        $mock->expects($this->exactly(2))
        ->method('calcularFactorial')
        ->will($this->onConsecutiveCalls(120, 6));

        $this->assertSame(20, $mock->calcularPermutacion(5, 2));
    }

    public function testComprobarLlamada()
    {
        $mock = $this->getMockBuilder('Calculadora')
            ->onlyMethods(array('calcularFactorial'))
            ->getMock();
            
            /* $mock->expects($this->exactly(2))
            ->method('calcularFactorial')
            ->withConsecutive([5], [3]);

            $mock->calcularFactorial(5);
            $mock->calcularFactorial(3); */
            
            /*$mock->expects($this->once())
            ->method('calcularFactorial')
            ->with(5)
            ->will($this->returnvalue(120));
            $resultado_calculado = $mock->calcularFactorial(5);
            $this->assertEquals(120, $resultado_calculado);
            //$mock->calcularFactorial(3);
            $this->assertEquals(12, $resultado_calculado);*/

            $mock->expects($this->exactly(2))
              ->method('calcularFactorial')
              ->withConsecutive([5],[3])
              ->will($this->onConsecutiveCalls(120, 6));
            $this->assertEquals(120, $mock->calcularFactorial(5));
            $this->assertEquals(6, $mock->calcularFactorial(3));
    }
}