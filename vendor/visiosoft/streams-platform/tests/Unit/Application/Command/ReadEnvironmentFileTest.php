<?php

class ReadEnvironmentFileTest extends TestCase
{

    use \Illuminate\Foundation\Bus\DispatchesJobs;

    public function testCanReadEnvironmentFile()
    {
        $data = $this->dispatchNow(new \Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile());

        $this->assertTrue(isset($data['INSTALLED']));
    }
}
