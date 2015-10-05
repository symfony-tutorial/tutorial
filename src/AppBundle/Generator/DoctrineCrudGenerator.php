<?php

namespace AppBundle\Generator;

use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator as CrudGenerator;

class DoctrineCrudGenerator extends CrudGenerator
{

    private $intCounter = 1;

    protected function generateTestClass()
    {
        $parts = explode('\\', $this->entity);
        $entityClass = array_pop($parts);
        $entityNamespace = implode('\\', $parts);
        $dir = $this->bundle->getPath() . '/Tests/Controller';
        $target = $dir . '/' . str_replace('\\', '/', $entityNamespace) .
                '/' . $entityClass . 'ControllerTest.php';
        $this->renderFile('crud/tests/test.php.twig', $target, array(
            'route_prefix' => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'entity' => $this->entity,
            'bundle' => $this->bundle->getName(),
            'entity_class' => $entityClass,
            'namespace' => $this->bundle->getNamespace(),
            'entity_namespace' => $entityNamespace,
            'actions' => $this->actions,
            'form_type_name' => strtolower(
                    str_replace('\\', '_', $this->bundle->getNamespace()) .
                    ($parts ? '_' : '') .
                    implode('_', $parts) . '_'
                    . $entityClass
            ),
            'fields' => $this->getFormFields(),
        ));
    }

    private function getFormFields()
    {
        $fields = array();
        foreach ($this->metadata->getFieldNames() as $fieldName) {
            if (in_array($fieldName, $this->metadata->getIdentifier())) {
                continue;
            }
            $metadata = $this->metadata->getFieldMapping($fieldName);
            $value = null;
            switch ($metadata['type']) {
                case 'string':
                    $value = substr('str_' . $fieldName, 0, $metadata['length']);
                    break;
                case 'smallint':
                case 'int':
                case 'tinyint':
                    $value = $this->intCounter++;
                    break;
                default:
                    throw new \Exception(sprintf('Unsupported type %s', $metadata['type']));
            }
            $fields[] = array(
                'name' => $fieldName,
                'value' => $value
            );
        }
        return $fields;
    }

}
