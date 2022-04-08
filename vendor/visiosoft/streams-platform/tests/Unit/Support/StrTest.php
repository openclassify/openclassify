<?php

class StrTest extends TestCase
{

    public function testCanHumanizeString()
    {
        $this->assertEquals('ryan thompson', (new \Anomaly\Streams\Platform\Support\Str())->humanize('ryan_thompson'));
    }

    public function testCanTruncateString()
    {
        $this->assertEquals('Ryan...', (new \Anomaly\Streams\Platform\Support\Str())->truncate('Ryan Thompson', 7));
    }

    /**
     * @dataProvider linkifyDataProvider
     */
    public function testLinkify(string $text, array $attributes, string $expected): void
    {
        self::assertSame(
            $expected,
            (new \Anomaly\Streams\Platform\Support\Str())->linkify($text, ['attr' => $attributes])
        );
    }

    /**
     * @return array[]
     */
    public function linkifyDataProvider(): array
    {
        return [
            'one url' => [
                'Some http://example.com text',
                [],
                'Some <a href="http://example.com">http://example.com</a> text',
            ],
            'two urls' => [
                'Visit http://example.com, and see some example.com content.',
                [],
                'Visit <a href="http://example.com">http://example.com</a>, and see some <a href="http://example.com">example.com</a> content.',
            ],
            'html special chars encoded' => [
                'Some &lt;b&gt;http://example.com&lt;/b&gt; text',
                [],
                'Some &lt;b&gt;<a href="http://example.com">http://example.com</a>&lt;/b&gt; text',
            ],
            'already highlighted' => [
                'Some <a href="http://example.com">http://example.com</a> text',
                [],
                'Some <a href="http://example.com">http://example.com</a> text',
            ],
            'email' => [
                'Some user@example.com text',
                [],
                'Some <a href="mailto:user@example.com">user@example.com</a> text',
            ],
            'attributes' => [
                'Some http://example.com text',
                ['target' => '_blank'],
                'Some <a href="http://example.com" target="_blank">http://example.com</a> text',
            ],
        ];
    }
}
