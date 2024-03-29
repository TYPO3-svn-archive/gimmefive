<?php
/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

require_once (t3lib_extMgm::extPath('gimmefive') . 'Classes/Component/F3_GimmeFive_Component_Manager.php');
require_once(t3lib_extMgm::extPath('gimmefive') . 'Tests/Fixtures/F3_GimmeFive_Fixture_DummyClass.php');

/**
 * Test for the Components of the extension 'gimmefive'
 *
 * @package	TYPO3
 * @subpackage	F3_GimmeFive
 */
class F3_GimmeFive_Component_ObjectBuilder_testcase extends PHPUnit_Framework_TestCase {

	/**
	 * @var F3_FLOW3_Component_ObjectBuilder
	 */
	protected $componentObjectBuilder;

	/**
	 * Sets up this test case
	 *
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setUp() {
		$this->componentManager = F3_GimmeFive_Component_Manager::getInstance();
		$this->componentObjectBuilder = F3_GimmeFive_Component_Manager::getInstance();
	}

	/**
	 * Checks if createComponentObject does a simple setter injection correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoSimpleExplicitSetterInjection() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertTrue($componentObject->getFirstDependency() instanceof F3_TestPackage_InjectedClass, 'The class F3_TestPackage_Injected class (first dependency) has not been setter-injected although it should have been.');
	}

	/**
	 * Checks if createComponentObject does a setter injection with straight values correctly (in this case a string)
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoSetterInjectionWithStraightValues() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$time = microtime();
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$someConfigurationProperty = new F3_FLOW3_Component_ConfigurationProperty('someProperty', $time, F3_FLOW3_Component_ConfigurationProperty::PROPERTY_TYPES_STRAIGHTVALUE);
		$componentConfiguration->setProperty($someConfigurationProperty);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertEquals($time, $componentObject->getSomeProperty(), 'The straight value has not been setter-injected although it should have been.');
	}

	/**
	 * Checks if createComponentObject does a setter injection with arrays correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoSetterInjectionWithArrays() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$someArray = array(
			'foo' => 'bar',
			199 => 837,
			'doo' => TRUE
		);
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$someConfigurationProperty = new F3_FLOW3_Component_ConfigurationProperty('someProperty', $someArray, F3_FLOW3_Component_ConfigurationProperty::PROPERTY_TYPES_STRAIGHTVALUE);
		$componentConfiguration->setProperty($someConfigurationProperty);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertEquals($someArray, $componentObject->getSomeProperty(), 'The array has not been setter-injected although it should have been.');
	}

	/**
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createObjectCanDoSetterInjectionViaInjectMethod() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertTrue($componentObject->getSecondDependency() instanceof F3_TestPackage_InjectedClass, 'The class F3_TestPackage_Injected class (second dependency) has not been setter-injected although it should have been.');
	}

	/**
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function injectMethodIsPreferredOverSetMethod() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertEquals('inject', $componentObject->injectOrSetMethod, 'Setter inject was done via the set* method but inject* should have been preferred!');
	}

	/**
	 * Checks if createComponentObject does a simple constructor injection correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoSimpleConstructorInjection() {
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_ClassWithOptionalConstructorArguments');
		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());

		$injectionSucceeded = (
			$componentObject->argument1 instanceof F3_TestPackage_InjectedClass &&
			$componentObject->argument2 === 42 &&
			$componentObject->argument3 === 'Foo Bar Skårhøj'
		);

		$this->assertTrue($injectionSucceeded, 'The class F3_TestPackage_Injected class has not been (correctly) constructor-injected although it should have been.');
	}

	/**
	 * Checks if createComponentObject does a constructor injection with a third dependency correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoConstructorInjectionWithThirdDependency() {
			// load and modify the configuration a bit:
			// ClassWithOptionalConstructorArguments depends on InjectedClassWithDependencies which depends on InjectedClass
		$componentConfigurations = $this->componentManager->getComponentConfigurations();
		$componentConfigurations['F3_TestPackage_ClassWithOptionalConstructorArguments']->setConstructorArgument(new F3_FLOW3_Component_ConfigurationArgument(1, 'F3_TestPackage_InjectedClassWithDependencies', F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_REFERENCE));
		$this->componentManager->setComponentConfigurations($componentConfigurations);
		$componentConfiguration = $componentConfigurations['F3_TestPackage_ClassWithOptionalConstructorArguments'];

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());

		$this->assertTrue($componentObject->argument1->injectedDependency instanceof F3_TestPackage_InjectedClass, 'Constructor injection with multiple dependencies failed.');
	}

	/**
	 * Checks if createComponentObject does a constructor injection with arrays correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoConstructorInjectionWithArrays() {
		$someArray = array(
			'foo' => 'bar',
			199 => 837,
			'doo' => TRUE
		);
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_ClassWithOptionalConstructorArguments');
		$configurationArgument = new F3_FLOW3_Component_ConfigurationArgument(1, $someArray, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE);
		$componentConfiguration->setConstructorArgument($configurationArgument);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());
		$this->assertEquals($someArray, $componentObject->argument1, 'The array has not been constructor-injected although it should have been.');
	}

	/**
	 * Checks if createComponentObject does a constructor injection with numeric values correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoConstructorInjectionWithNumericValues() {
		$secondValue = 99;
		$thirdValue = 3.14159265359;
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_ClassWithOptionalConstructorArguments');
		$configurationArguments = array(
			new F3_FLOW3_Component_ConfigurationArgument(2, $secondValue, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE),
			new F3_FLOW3_Component_ConfigurationArgument(3, $thirdValue, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE)
		);
		$componentConfiguration->setConstructorArguments($configurationArguments);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());
		$this->assertEquals($secondValue, $componentObject->argument2, 'The second straight numeric value has not been constructor-injected although it should have been.');
		$this->assertEquals($thirdValue, $componentObject->argument3, 'The third straight numeric value has not been constructor-injected although it should have been.');
	}

	/**
	 * Checks if createComponentObject does a constructor injection with boolean values and objects correctly
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoConstructorInjectionWithBooleanValuesAndObjects() {
		$firstValue = TRUE;
		$thirdValue = new ArrayObject(array('foo' => 'bar'));
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_ClassWithOptionalConstructorArguments');
		$configurationArguments = array(
			new F3_FLOW3_Component_ConfigurationArgument(1, $firstValue, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE),
			new F3_FLOW3_Component_ConfigurationArgument(3, $thirdValue, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE)
		);
		$componentConfiguration->setConstructorArguments($configurationArguments);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());
		$this->assertEquals($firstValue, $componentObject->argument1, 'The first value (boolean) has not been constructor-injected although it should have been.');
		$this->assertEquals($thirdValue, $componentObject->argument3, 'The third argument (an object) has not been constructor-injected although it should have been.');
	}

	/**
	 * Checks if createComponentObject can handle difficult constructor arguments (with quotes, special chars etc.)
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCanDoConstructorInjectionWithDifficultArguments() {
		$firstValue = "Hir hier deser d'Sonn am, fu dem Ierd d'Liewen, ze schéinste Kirmesdag hannendrun déi.";
		$secondValue = 'Oho ha halo\' maksimume, "io fari jeso naŭ plue" om backslash (\\)nea komo triliono postpostmorgaŭ.';

		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_ClassWithOptionalConstructorArguments');
		$configurationArguments = array(
			new F3_FLOW3_Component_ConfigurationArgument(1, $firstValue, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE),
			new F3_FLOW3_Component_ConfigurationArgument(2, $secondValue, F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_STRAIGHTVALUE),
		);
		$componentConfiguration->setConstructorArguments($configurationArguments);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());
		$this->assertEquals($firstValue, $componentObject->argument1, 'The first value (string with quotes) has not been constructor-injected although it should have been.');
		$this->assertEquals($secondValue, $componentObject->argument2, 'The second value (string with double quotes and backslashes) has not been constructor-injected although it should have been.');
	}

	/**
	 * Checks if the component manager itself can be injected by constructor injection
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function constructorInjectionOfComponentManagerWorks() {
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_ClassWithOptionalConstructorArguments');
		$configurationArguments = array(
			new F3_FLOW3_Component_ConfigurationArgument(1, 'F3_FLOW3_Component_ManagerInterface', F3_FLOW3_Component_ConfigurationArgument::ARGUMENT_TYPES_REFERENCE),
		);
		$componentConfiguration->setConstructorArguments($configurationArguments);

		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());
		$this->assertType('F3_FLOW3_Component_ManagerInterface', $componentObject->argument1, 'The component manager has not been constructor-injected although it should have been.');

		$secondComponentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_ClassWithOptionalConstructorArguments', $componentConfiguration, array());
		$this->assertSame($componentObject->argument1, $secondComponentObject->argument1, 'The constructor-injected instance of the component manager was not a singleton!');
	}

	/**
	 * Checks if the component manager itself can be injected by setter injection
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function setterInjectionOfComponentManagerWorks() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$someConfigurationProperty = new F3_FLOW3_Component_ConfigurationProperty('someProperty', 'F3_FLOW3_Component_ManagerInterface', F3_FLOW3_Component_ConfigurationProperty::PROPERTY_TYPES_REFERENCE);
		$componentConfiguration->setProperty($someConfigurationProperty);
		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertType('F3_FLOW3_Component_ManagerInterface', $componentObject->getSomeProperty(), 'The component manager has not been setter-injected although it should have been.');
	}

	/**
	 * Checks if the object builder calls the lifecycle initialization method after injecting properties
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function createComponentObjectCallsLifecycleInitializationMethod() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_BasicClass');
		$componentObject = $this->componentObjectBuilder->createComponentObject('F3_TestPackage_BasicClass', $componentConfiguration, array());
		$this->assertTrue($componentObject->hasBeenInitialized(), 'Obviously the lifecycle initialization method of F3_TestPackage_BasicClass has not been called after setter injection!');
	}

	/**
	 * Checks if autowiring of constructor arguments for dependency injection basically works
	 *
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function autoWiringWorksForConstructorInjection() {
		$componentConfiguration = $this->componentManager->getComponentConfiguration('F3_TestPackage_InjectedClassWithDependencies');
		$component = $this->componentManager->getComponent('F3_TestPackage_ClassWithSomeImplementationInjected');
		$this->assertType('F3_TestPackage_SomeImplementation', $component->argument1, 'Autowiring didn\'t work out for F3_TestPackage_ClassWithSomeImplementationInjected');
	}

	/**
	 * Checks if autowiring doesn't override constructor arguments which have already been defined in the component configuration
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function autoWiringForConstructorInjectionRespectsAlreadyDefinedArguments() {
		$component = $this->componentManager->getComponent('F3_TestPackage_ClassWithSomeImplementationInjected');
		$this->assertTrue($component->argument2 instanceof F3_TestPackage_InjectedClassWithDependencies, 'Autowiring didn\'t respect that the second constructor argument was already set in the Components.ini!');
	}

	/**
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function autoWiringWorksForSetterInjectionViaInjectMethod() {
		$this->markTestIncomplete('This feature of FLOW3 is not implemented in GimmeFive yet.');
		$component = $this->componentManager->getComponent('F3_TestPackage_ClassWithSomeImplementationInjected');
		$this->assertTrue($component->optionalSetterArgument instanceof F3_TestPackage_SomeInterface, 'Autowiring didn\'t work for the optional setter injection via the inject*() method.');
	}

	/**
	 * @test
	 * @author Robert Lemke <robert@typo3.org>
	 */
	public function autoWiringThrowsExceptionForUnmatchedDependenciesOfRequiredSetterInjectedDependencies() {
		try {
			$component = $this->componentManager->getComponent('F3_TestPackage_ClassWithUnmatchedRequiredSetterDependency');
			$this->fail('The object builder did not throw an exception.');
		} catch (F3_FLOW3_Component_Exception_CannotBuildObject $exception) {
		}
	}
}
?>