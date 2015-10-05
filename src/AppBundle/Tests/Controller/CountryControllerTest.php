<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpKernel\Client;

class CountryControllerTest extends WebTestCase
{
    
    public function testIndexAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/country');
        $unexpectedStatus = "Unexpected HTTP status code for GET /country";
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), $unexpectedStatus);
    }
    
    public function testNewAction()
    {
        $client = static::createClient();
        $crawler = $this->createNewEntity($client, '/country', 'appbundle_country');

        foreach ($this->getNewFormFields() as $value) {
            $missingElementError = sprintf('Missing element td:contains("%s")', $value);
            $valueCount = $crawler->filter(sprintf('td:contains("%s")', $value))->count();
            $this->assertGreaterThan(0, $valueCount, $missingElementError);
        }
    }
    
    public function testUpdateAction()
    {
        $client = static::createClient();
        $crawler = $this->createNewEntity($client, '/country', 'appbundle_country');
        
        $crawler = $client->click($crawler->selectLink('Edit')->link());
        
        $formFields = $this->getUpdateFormFields();

        $form = $crawler->selectButton('Update')->form(
            $this->constructFormValues($formFields, 'appbundle_country')
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        foreach ($this->getUpdateFormFields() as $value) {
            $missingElementError = sprintf('Missing element td:contains("%s")', $value);
            $valueCount = $crawler->filter(sprintf('[value="%s"]', $value))->count();
            $this->assertGreaterThan(0, $valueCount, $missingElementError);
        }
    }
    
    /**
     * 
     * @return array 'field_name'=>'value' to be used for testNewAction
     */
    protected function getNewFormFields()
    {
            return array(
                'code' => 'str_c',
                'name' => 'str_name',
                'currency' => 'str',
                );
    }
    /**
     * 
     * @return array 'field_name'=>'value' to be used for testUpdateAction
     */
    protected function getUpdateFormFields()
    {
        return $this->getNewFormFields();
    }
    
    protected function constructFormValues($fields, $formTypeName)
    {
        $values = array();
        foreach ($fields as $fieldName => $value) {
            $values[sprintf('%s[%s]', $formTypeName, $fieldName)] = $value;
        }
        return $values;
    }
    
    protected function createNewEntity(Client $client, $routePrefix, $formTypeName)
    {
        $crawler = $client->request('GET', $routePrefix);
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        $form = $crawler->selectButton('Create')->form(
                $this->constructFormValues($this->getNewFormFields(), $formTypeName)
        );

        $client->submit($form);
        return $client->followRedirect();
    }
        
}
