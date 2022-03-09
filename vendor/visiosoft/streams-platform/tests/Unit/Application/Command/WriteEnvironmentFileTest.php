<?php

class WriteEnvironmentFileTest extends TestCase
{

    use \Illuminate\Foundation\Bus\DispatchesJobs;

    public function testCanWriteEnvironmentFile()
    {
        $this->markTestSkipped('We should not be touching the file.');

        return;
        
        $this->dispatchNow(
            new \Anomaly\Streams\Platform\Application\Command\WriteEnvironmentFile(
                array_merge(
                    $this->dispatchNow(new \Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile()),
                    ['DUMMY_TEST' => ($time = time())]
                )
            )
        );

        $data = $this->dispatchNow(new \Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile());

        $this->assertTrue($data['DUMMY_TEST'] == $time);
    }
}
