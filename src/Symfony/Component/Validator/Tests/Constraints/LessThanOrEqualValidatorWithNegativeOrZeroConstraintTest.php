<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Tests\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NegativeOrZero;

/**
 * @author Jan Schädlich <jan.schaedlich@sensiolabs.de>
 */
class LessThanOrEqualValidatorWithNegativeOrZeroConstraintTest extends LessThanOrEqualValidatorTest
{
    protected function createConstraint(array $options = null): Constraint
    {
        return new NegativeOrZero();
    }

    /**
     * {@inheritdoc}
     */
    public function provideValidComparisons(): array
    {
        return [
            [0, 0],
            [-1, 0],
            [-2, 0],
            [-2.5, 0],
            [null, 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function provideInvalidComparisons(): array
    {
        return [
            [2, '2', 0, '0', 'integer'],
            [2.5, '2.5', 0, '0', 'integer'],
            [333, '333', 0, '0', 'integer'],
        ];
    }

    public function testThrowsConstraintExceptionIfPropertyPath()
    {
        $this->expectException('Symfony\Component\Validator\Exception\ConstraintDefinitionException');
        $this->expectExceptionMessage('The "propertyPath" option of the "Symfony\Component\Validator\Constraints\NegativeOrZero" constraint cannot be set.');

        return new NegativeOrZero(['propertyPath' => 'field']);
    }

    public function testThrowsConstraintExceptionIfValue()
    {
        $this->expectException('Symfony\Component\Validator\Exception\ConstraintDefinitionException');
        $this->expectExceptionMessage('The "value" option of the "Symfony\Component\Validator\Constraints\NegativeOrZero" constraint cannot be set.');

        return new NegativeOrZero(['value' => 0]);
    }

    /**
     * @dataProvider provideInvalidConstraintOptions
     */
    public function testThrowsConstraintExceptionIfNoValueOrPropertyPath($options)
    {
        $this->expectException('Symfony\Component\Validator\Exception\ConstraintDefinitionException');
        $this->expectExceptionMessage('requires either the "value" or "propertyPath" option to be set.');
        $this->markTestSkipped('Value option always set for NegativeOrZero constraint');
    }

    public function testThrowsConstraintExceptionIfBothValueAndPropertyPath()
    {
        $this->expectException('Symfony\Component\Validator\Exception\ConstraintDefinitionException');
        $this->expectExceptionMessage('requires only one of the "value" or "propertyPath" options to be set, not both.');
        $this->markTestSkipped('Value option is set for NegativeOrZero constraint automatically');
    }

    public function testNoViolationOnNullObjectWithPropertyPath()
    {
        $this->markTestSkipped('PropertyPath option is not used in NegativeOrZero constraint');
    }

    public function testInvalidValuePath()
    {
        $this->markTestSkipped('PropertyPath option is not used in NegativeOrZero constraint');
    }

    /**
     * @dataProvider provideValidComparisonsToPropertyPath
     */
    public function testValidComparisonToPropertyPath($comparedValue)
    {
        $this->markTestSkipped('PropertyPath option is not used in NegativeOrZero constraint');
    }

    /**
     * @dataProvider provideValidComparisonsToPropertyPath
     */
    public function testValidComparisonToPropertyPathOnArray($comparedValue)
    {
        $this->markTestSkipped('PropertyPath option is not used in NegativeOrZero constraint');
    }

    public function testInvalidComparisonToPropertyPathAddsPathAsParameter()
    {
        $this->markTestSkipped('PropertyPath option is not used in NegativeOrZero constraint');
    }
}