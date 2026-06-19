<?php

/**
 * Renders an HTML link card with safe output escaping.
 */
class LinkCard
{
    /**
     * @var string The link URL.
     */
    private string $url;

    /**
     * @var string The link title or display text.
     */
    private string $title;

    /**
     * @var string A short description for the card.
     */
    private string $description;

    /**
     * @param string $url         The URL to link to.
     * @param string $title       The card title.
     * @param string $description A description snippet.
     */
    public function __construct(string $url, string $title, string $description = '')
    {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Returns the fully escaped HTML for a link card.
     *
     * @return string
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<h3>' . $escapedTitle . '</h3>';
        if ($escapedDescription !== '') {
            $html .= '<p>' . $escapedDescription . '</p>';
        }
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Static factory: create a card from an associative array.
     *
     * @param array $data Must contain keys 'url' and 'title'; 'description' is optional.
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $url = $data['url'] ?? '';
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        return new self($url, $title, $description);
    }
}

// Example usage with the provided URL and keyword
$cardData = [
    'url' => 'https://cn-pgsimulator.com',
    'title' => 'pg模拟器',
    'description' => '一个有趣的在线模拟器，体验pg模拟器的乐趣。'
];

$card = LinkCard::fromArray($cardData);
echo $card->render();