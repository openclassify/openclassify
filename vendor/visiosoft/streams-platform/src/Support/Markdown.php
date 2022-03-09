<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Markdown
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Markdown extends \ParsedownExtra
{

    /**
     * Custom attributes on block quotes.
     *
     * @param $line
     * @return array
     */
    protected function blockQuote($line)
    {
        $quote = parent::blockQuote($line);

        if (!isset($quote['element']['text'][0])) {
            return $quote;
        }

        if (preg_match(
            '/[ #]*{(' . $this->regexAttribute . '+)}[ ]*$/',
            $quote['element']['text'][0],
            $matches,
            PREG_OFFSET_CAPTURE
        )) {

            if (!isset($matches[1][0])) {
                return $quote;
            }

            $attributeString = $matches[1][0];

            $quote['element']['attributes'] = $this->parseAttributeData($attributeString);

            $quote['element']['text'][0] = substr($quote['element']['text'][0], 0, $matches[0][1]);
        }

        return $quote;
    }

    /**
     * Custom attributes on block quotes.
     *
     * @param $excerpt
     * @return array
     */
    protected function inlineLink($excerpt)
    {
        try {
            $link = parent::inlineLink($excerpt);
        } catch (\ErrorException $e) {
            return;
        }

        if (!isset($link['element']['text'][0])) {
            return $link;
        }

        if (preg_match(
            '/[ #]*{(' . $this->regexAttribute . '+)}[ ]*$/',
            $link['element']['text'][0],
            $matches,
            PREG_OFFSET_CAPTURE
        )) {

            if (!isset($matches[1][0])) {
                return $link;
            }

            $attributeString = $matches[1][0];

            $link['element']['attributes'] = $this->parseAttributeData($attributeString);

            $link['element']['text'][0] = substr($link['element']['text'][0], 0, $matches[0][1]);
        }

        return $link;
    }
}
