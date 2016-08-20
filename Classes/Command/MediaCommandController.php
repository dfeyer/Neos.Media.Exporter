<?php
namespace Neos\Media\Exporter\Command;

/*
 * This file is part of the Neos.Media.Exporter package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Media\Exporter\Domain\Service\AssetExporterService;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;
use TYPO3\Flow\Utility\Files;

/**
 * The Asset Command Controller
 *
 * @Flow\Scope("singleton")
 */
class MediaCommandController extends CommandController
{
    /**
     * @var AssetExporterService
     * @Flow\Inject
     */
    protected $exporterService;

    /**
     * Export all assets
     *
     * Create a single YAML file with assets metadata and
     * one file per asset in the directory Resources
     * in the directory containing the XML file.
     *
     * @param string $directory
     */
    public function exportCommand(string $directory)
    {
        $this->exporterService->export($directory);
    }

    /**
     * Import assets
     *
     * @param string $filename
     */
    public function importCommand(string $filename)
    {

    }
}
