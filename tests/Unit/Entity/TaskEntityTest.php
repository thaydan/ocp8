<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Task;
use App\Tests\Unit\AbstractKernelTestCase;
use DateTimeImmutable;
use Exception;
use Faker\Factory as Faker;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionUnionType;

class TaskEntityTest extends AbstractKernelTestCase
{
    public function testTaskEntityIsValid (): void
    {
        $task = new Task();
        $task
            ->setTitle('task one')
            ->setContent('content task one')
            ->setUser(null)
            ->setCreatedAt(new DateTimeImmutable())
        ;

        $errors = $this->validator->validate($task);
        $this->assertCount(0, $errors);
    }


    /**
     * @throws Exception
     */
    public function testGetters(): void
    {
        $bookReflection = new ReflectionClass(Task::class);

        $task = (new Task());

        foreach ($bookReflection->getProperties() as $reflectionProperty) {
            if ($reflectionProperty->getName() === 'id') {
                continue;
            }

            $propertyFakeValue = $this->getFakeValue($reflectionProperty->getType());
            $propertyName = $reflectionProperty->getName();

            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($task, $propertyFakeValue);

            $getterName = 'get' . ucfirst($propertyName);

            if (!$bookReflection->hasMethod($getterName)) {
                continue;
            }

            self::assertEquals($propertyFakeValue, $task->$getterName());
        }
    }

    /**
     * @throws Exception
     */
    public function testSetters(): void
    {
        $bookReflection = new ReflectionClass(Task::class);

        $task = (new Task());

        foreach ($bookReflection->getProperties() as $reflectionProperty) {
            $reflectionProperty->setAccessible(true);
            $propertyFakeValue = $this->getFakeValue($reflectionProperty->getType());
            $propertyName = $reflectionProperty->getName();

            $setterName = 'set' . ucfirst($propertyName);

            if (!$bookReflection->hasMethod($setterName)) {
                continue;
            }

            $task->$setterName($propertyFakeValue);

            self::assertEquals($propertyFakeValue, $reflectionProperty->getValue($task));
        }
    }

    /**
     * @throws Exception
     */
    private function getFakeValue(ReflectionUnionType|ReflectionNamedType|null $reflectionType): bool|int|string|DateTimeImmutable|null
    {
        if ($reflectionType instanceof ReflectionUnionType) {
            $typeName = $reflectionType->getTypes()[0]->getName();
        } elseif ($reflectionType instanceof ReflectionNamedType) {
            $typeName = $reflectionType->getName();
        } else {
            return null;
        }

        $faker = Faker::create();

        return match ($typeName) {
            'int' => $faker->numberBetween(),
            'string' => $faker->text(),
            'DateTime' | 'DateTimeImmutable' => new DateTimeImmutable(),
            'bool' => true,
            default => throw new Exception()
        };
    }
}
