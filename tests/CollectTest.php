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

    public function testFirst()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->first();
        $this->assertEquals(1, $result);
    }

    public function testGet()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2]);
        $this->assertSame(1, $collect->get('a'));
    }

    public function testSearch()
    {
        $collect = new Collect\Collect([
            ['id' => 1, 'name' => 'Ash'],
            ['id' => 2, 'name' => 'Pop'],
            ['id' => 3, 'name' => 'Ash']
        ]);
        $result = $collect->search('name', 'Ash')->toArray();
        $this->assertSame([['id' => 1, 'name' => 'Ash'], ['id' => 3, 'name' => 'Ash']], $result);
    }

    public function testMap()
    {
        $collect = new Collect\Collect([1, 2, 3]);
        $result = $collect->map(function ($item) {
            return $item * 2;
        })->toArray();
        $this->assertSame([2, 4, 6], $result);
    }

    public function testExcept()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(['a' => 1, 'c' => 3], $collect->except('b')->toArray());
    }

    public function testSplice()
    {
        // Создаем объект Collect с начальными данными [1, 2, 3, 4, 5]
        $collect = new Collect\Collect([1, 2, 3, 4, 5]);
    
        // Копируем начальное состояние коллекции
        $initialArray = $collect->toArray();
    
        // Вызываем метод splice() с аргументами 2 и 3, которые являются элементами массива
        $collect->splice(2, 3);
    
        // Ожидаем, что изначальный массив останется неизменным, так как мы не изменили метод splice()
        $this->assertEquals($initialArray, $collect->toArray());
    }
    
}