<?php

use PHPUnit\Framework\TestCase;

class CollectTest extends TestCase
{
    public function testCount()
    {
        $collect = new Collect\Collect([13, 17]);
        $this->assertSame(2, $collect->count());
    }


    public function testUnshift()
    {
        $collect = $this->getMockBuilder(Collect\Collect::class)
            ->onlyMethods(['unshift'])
            ->getMock();

        $collect->expects($this->once())
            ->method('unshift')
            ->with([0, -1]);

        $collect->unshift([0, -1]);
    }


    public function testShift()
    {
        $collect = new Collect\Collect([1, 2, 3, 4]);
        $result = $collect->shift();
        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals([2, 3, 4], $result->toArray());
    }

    public function testPush()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $result = $collect->push(4);
        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals([1, 2, 3, 4], $result->toArray());
    }


    public function testOnly()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->only('a', 'c');
        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals(['a' => 1, 'c' => 3], $result->toArray());
    }

    public function testKeys()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->keys();
        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals(['a', 'b', 'c'], $result->toArray());
    }

    public function testValues()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->values();
        $this->assertInstanceOf(Collect\Collect::class, $result);
        $this->assertEquals([1, 2, 3], $result->toArray());
    }

    public function testToArray()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3], $collect->toArray());
    }

    public function testPop()
    {
        $collect = new Collect\Collect([1, 2, 3]);

        $result = $collect->pop();

        $this->assertInstanceOf(Collect\Collect::class, $result);

        $this->assertEquals([1, 2], $result->toArray());
    }
    public function testSplice()
    {
        // Создаем объект Collect с начальными данными [1, 2, 3, 4, 5]
        $collect = new Collect\Collect([1, 2, 3, 4, 5]);

        // Копируем начальное состояние коллекции
        $initialArray = $collect->toArray();

        // Вызываем метод splice() с аргументом 1 и 2
        $result = $collect->splice(1, 2);

        // Проверяем, что метод splice() возвращает объект Collect
        $this->assertInstanceOf(Collect\Collect::class, $result);

        // Проверяем, что метод splice() не изменяет данные, а только возвращает объект
        $this->assertEquals($initialArray, $collect->toArray());
    }


    // public function testExcept()
    // {
    //     // Создаем объект Collect с начальными данными ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]
    //     $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);

    //     // Вызываем метод except() с аргументами 'b' и 'c'
    //     $result = $collect->except('b', 'c');

    //     // Проверяем, что метод except() возвращает объект Collect
    //     $this->assertInstanceOf(Collect\Collect::class, $result);

    //     // Проверяем, что метод except() правильно исключает элементы из коллекции
    //     $this->assertEquals(['a' => 1, 'd' => 4], $result->toArray());
    // }

    public function testFirst()
    {
        // Создаем объект Collect с начальными данными ['a' => 1, 'b' => 2, 'c' => 3]
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);

        // Вызываем метод first()
        $result = $collect->first();

        // Проверяем, что метод first() возвращает первый элемент коллекции
        $this->assertEquals(1, $result);
    }

    public function testGet()
    {
        // Создаем объект Collect с начальными данными ['a' => 1, 'b' => 2, 'c' => 3]
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);

        // Проверяем, что метод get() без аргумента возвращает всю коллекцию
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3], $collect->get());

        // Проверяем, что метод get() с аргументом 'b' возвращает значение для ключа 'b'
        $this->assertEquals(2, $collect->get('b'));

        // Проверяем, что метод get() с несуществующим аргументом возвращает null
        $this->assertNull($collect->get('d'));
    }

}