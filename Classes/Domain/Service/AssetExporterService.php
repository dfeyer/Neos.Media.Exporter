<?php
namespace Neos\Media\Exporter\Domain\Service;

/*
 * This file is part of the Neos.Media.Exporter package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Symfony\Component\Yaml\Yaml;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;
use TYPO3\Flow\Property\PropertyMapper;
use TYPO3\Flow\Utility\Arrays;
use TYPO3\Flow\Utility\Files;
use TYPO3\Flow\Utility\Now;
use TYPO3\Media\Domain\Model\Asset;
use TYPO3\Media\Domain\Model\AssetCollection;
use TYPO3\Media\Domain\Model\Tag;
use TYPO3\Media\Domain\Repository\AssetCollectionRepository;
use TYPO3\Media\Domain\Repository\AssetRepository;
use TYPO3\Media\Domain\Repository\TagRepository;

/**
 * Asset Exporter Service
 *
 * @Flow\Scope("singleton")
 */
class AssetExporterService
{
    /**
     * @var AssetCollectionRepository
     * @Flow\Inject
     */
    protected $assetCollectionRepository;

    /**
     * @var TagRepository
     * @Flow\Inject
     */
    protected $tagRepository;

    /**
     * @var AssetRepository
     * @Flow\Inject
     */
    protected $assetRepository;

    /**
     * @var Now
     * @Flow\Inject
     */
    protected $now;

    /**
     * @var PersistenceManagerInterface
     * @Flow\Inject
     */
    protected $persistenceManager;

    /**
     * @var PropertyMapper
     * @Flow\Inject
     */
    protected $propertyMapper;

    /**
     * @var array
     */
    protected $defaultOptions = [
        'dateFormat' => 'Y-m-d-His',
        'steps' => [
            'tags' => true,
            'assetCollections' => true,
            'assets' => true,
            'compress' => false,
            'clean' => false,
        ],
    ];

    /**
     * @param string $directory
     * @param array $options
     */
    public function export(string $directory, array $options = [])
    {
        $options = Arrays::arrayMergeRecursiveOverrule($this->defaultOptions, $options);

        $timestamp = $this->now->format($options['dateFormat']);
        $path = Files::concatenatePaths([$directory, $timestamp]);

        if (Arrays::getValueByPath($options, 'steps.assetCollections') === true) {
            $this->exportAssetCollections($path);
        }
        if (Arrays::getValueByPath($options, 'steps.tags') === true) {
            $this->exportTags($path);
        }
        if (Arrays::getValueByPath($options, 'steps.assets') === true) {
            $this->exportAssets($path);
        }
        if (Arrays::getValueByPath($options, 'steps.compress') === true && extension_loaded('zip')) {
            $this->compress($path, Files::concatenatePaths([$directory, $timestamp . '.zip']));
        }
        if (Arrays::getValueByPath($options, 'steps.clean') === true) {
            $this->clean($path);
        }
    }

    /**
     * @param string $path
     */
    protected function exportTags(string $path)
    {
        $path = Files::concatenatePaths([$path, 'Tags']);
        Files::createDirectoryRecursively($path);
        /** @var Tag $tag */
        foreach ($this->tagRepository->findAll() as $tag) {
            $data = $this->propertyMapper->convert($tag, 'array');
            $this->dump($this->getIdentifier($tag), $data, $path);
        }
    }

    /**
     * @param string $path
     */
    protected function exportAssetCollections(string $path)
    {
        $path = Files::concatenatePaths([$path, 'AssetCollections']);
        Files::createDirectoryRecursively($path);
        /** @var AssetCollection $assetCollection */
        foreach ($this->assetCollectionRepository->findAll() as $assetCollection) {
            $data = $this->propertyMapper->convert($assetCollection, 'array');
            $this->dump($this->getIdentifier($assetCollection), $data, $path);
        }
    }

    /**
     * @param string $path
     */
    protected function exportAssets(string $path)
    {
        $path = Files::concatenatePaths([$path, 'Assets']);
        Files::createDirectoryRecursively($path);
        /** @var Asset $asset */
        foreach ($this->assetRepository->findAll() as $asset) {
            $implementation = get_class($asset);
            $data = $this->propertyMapper->convert($asset, 'array');
            $this->dump($this->getIdentifier($asset), $data, Files::concatenatePaths([
                $path,
                str_replace('\\', '/', $implementation)
            ]));
        }
    }

    /**
     * @param object|null $object
     * @return string|null
     */
    protected function getIdentifier($object)
    {
        return $object ? $this->persistenceManager->getIdentifierByObject($object) : null;
    }

    /**
     * @param $path
     * @param $filename
     */
    protected function compress(string $path, string $filename)
    {
        $rootPath = realpath($path);

        $zip = new \ZipArchive();
        $zip->open($filename, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
    }

    /**
     * @param $path
     */
    protected function clean(string $path)
    {
        Files::removeDirectoryRecursively($path);
    }

    /**
     * @param string $identifier
     * @param array $data
     * @param string $path
     */
    protected function dump(string $identifier, array $data, string $path)
    {
        $filename = Files::concatenatePaths([$path, $identifier . '.yaml']);
        Files::createDirectoryRecursively(dirname($filename));
        file_put_contents($filename, Yaml::dump($data));
    }
}
