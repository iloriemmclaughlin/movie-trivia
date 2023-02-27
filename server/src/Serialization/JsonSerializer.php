<?php

namespace App\Serialization;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonSerializer
{
    private const FORMAT_JSON = 'json';
    private Serializer $serializer;

    public function __construct()
    {
        $classMetaDataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $objectNormalizer = new ObjectNormalizer($classMetaDataFactory, null, null, new PhpDocExtractor());

        $this->serializer = new Serializer(
            [new ArrayDenormalizer(), new DateTimeNormalizer(), $objectNormalizer],
            [new JsonEncoder()]
        );
    }

    public function deserialize(string $json, string $class): object
    {
        return $this->serializer->deserialize($json, $class, self::FORMAT_JSON);
    }

    public function serialize(object|array $object): string
    {
        return $this->serializer->serialize($object, self::FORMAT_JSON);
    }
}