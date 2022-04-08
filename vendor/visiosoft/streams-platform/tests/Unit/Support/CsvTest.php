<?php

class CsvTest extends TestCase
{

    public function testCanReadCsvFileWithHeaders()
    {
        $data = (new \Anomaly\Streams\Platform\Support\Csv())
            ->setLength(9999)
            ->setEscape('\\')
            ->setDelimiter(',')
            ->setEnclosure('"')
            ->read(__DIR__ . '/resources/example-with-headers.csv');

        $this->assertEquals('ryan@pyrocms.com', $data[0]['email']);
    }

    public function testCanReadCsvFileWithoutHeaders()
    {
        $data = (new \Anomaly\Streams\Platform\Support\Csv())
            ->setHeader(false)
            ->read(__DIR__ . '/resources/example-no-headers.csv');

        $this->assertEquals('ryan@pyrocms.com', $data[0][0]);
    }
}
