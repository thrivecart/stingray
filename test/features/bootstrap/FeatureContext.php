<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use projectmeta\Stingray\Stingray;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        
        // Initialize your context here
        $this->stingray = new Stingray();
        $this->validator = Validation::createValidator();
    }

    /**                                                                                                                                                                                      
     * @Given /^a default array$/                                                                                                                                                            
     */                                                                                                                                                                                      
    public function aDefaultArray()                                                                                                                                                          
    {          
        
        //empty array
        $this->defaultArray = array();        
        
        //boolean values
        $this->defaultArray['boolean'] = array();
        $this->defaultArray['boolean']['true'] = true;
        $this->defaultArray['boolean']['false'] = false;
    
        //integer values
        $this->defaultArray['integer'] = array();
        $this->defaultArray['integer']['one'] = 1;
        $this->defaultArray['integer']['two'] = 2;
        $this->defaultArray['integer']['three'] = 3;
        
        //floating point number values
        $this->defaultArray['integer']['float'] = array();
        $this->defaultArray['integer']['float']['decimal'] = 1.234567890;
        $this->defaultArray['integer']['float']['exponent'] = array();
        $this->defaultArray['integer']['float']['exponent']['a'] = 1.2e3;
        $this->defaultArray['integer']['float']['exponent']['b'] = 7E-10;
        
        //string values
        $this->defaultArray['string'] = array();
        $this->defaultArray['string']['notblank'] = "not_blank";
        $this->defaultArray['string']['blank'] = "";
        $this->defaultArray['string']['null'] = null;
        
    }                                                                                                                                                                                        
                                                                                                                                                                                             
    /**                                                                                                                                                                                      
     * @Given /^a node alias "([^"]*)"$/                                                                                                                                                     
     */                                                                                                                                                                                      
    public function aNodeAlias($arg1)                                                                                                                                                        
    {           
        
        $this->nodeAlias = $arg1;
        
        
    }                                                                                                                                                                                        
                                                                                                                                                                                             
    /**                                                                                                                                                                                      
     * @Given /^a new value "([^"]*)"$/                                                                                                                                                      
     */                                                                                                                                                                                      
    public function aNewValue($arg1)                                                                                                                                                         
    {                                                                                                                                                                                        
        $this->newValue = $arg1;                                                                                                                                                        
    }                                                                                                                                                                                        
                                                                                                                                                                                             
    /**                                                                                                                                                                                      
     * @Then /^it should pass constraint "([^"]*)"$/                                                                                                                                                  
     */                                                                                                                                                                                      
    public function itShouldReturn($arg1)                                                                                                                                                    
    {   
        
        $value = $this->stingray->get($this->defaultArray, $this->nodeAlias);

        $this->validator->validateValue($value, new $arg1());
        
    }
    
    /**                                                                                                                                             
     * @Then /^it should be within "([^"]*)" and "([^"]*)"$/                                                                                        
     */                                                                                                                                             
    public function itShouldBeWithinAnd($arg1, $arg2)                                                                                               
    {   
        
        $value = $this->stingray->get($this->defaultArray, $this->nodeAlias);
 
        $this->validator->validateValue($value, new Assert\Range(array('min' => $arg1,'max' => $arg2)));

        
    }
    
    /**                                                                                                                                                                                      
     * @Then /^new value should pass constraint "([^"]*)"$/                                                                                                                                  
     */                                                                                                                                                                                      
    public function newValueShouldPassConstraint($arg1)                                                                                                                                      
    {         

        $this->stingray->set($this->defaultArray, $this->nodeAlias, $this->newValue);
        $value = $this->stingray->get($this->defaultArray, $this->nodeAlias);

        $this->validator->validateValue($value, new $arg1());
        
    }         

}
