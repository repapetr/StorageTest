<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Tests\Unit\Blob\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
namespace MicrosoftAzure\Storage\Tests\unit\Blob\Models;

use MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult;
use MicrosoftAzure\Storage\Common\Internal\Utilities;
use MicrosoftAzure\Storage\Tests\Framework\TestResources;

/**
 * Unit tests for class SetBlobPropertiesResult
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Tests\Unit\Blob\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */
class SetBlobPropertiesResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::setLastModified
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::getLastModified
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::setETag
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::getETag
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::setSequenceNumber
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::getSequenceNumber
     * @covers MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesResult::create
     */
    public function testCreate()
    {
        // Setup
        $sample = TestResources::ListBlobsOneEntry()['Blobs']['Blob']['Properties'];
        $expectedDate = Utilities::rfc1123ToDateTime($sample['Last-Modified']);

        // Test
        $result = SetBlobPropertiesResult::create($sample);

        // Assert
        $this->assertEquals($expectedDate, $result->getLastModified());
        $this->assertEquals($sample['x-ms-blob-sequence-number'], $result->getSequenceNumber());
        $this->assertEquals($sample['Etag'], $result->getETag());
    }
}
