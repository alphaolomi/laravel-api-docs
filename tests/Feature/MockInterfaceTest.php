<?php

// MockInterface

interface MyInterface
{
    public function foo();
}

class MyMock implements MyInterface
{
    public function foo()
    {
        return 'bar';
    }
}

