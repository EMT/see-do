<?php

namespace App\Helpers\Markdown;

trait MarkdownTrait
{
    private static $rules = [
        'links'                 => ['/\[([^\[]+)\]\(([^\)]+)\)/', '<a href=\'\2\'>\1</a>'],  // links
        'urls to links'         => ['@(?!(?!.*?<a)[^<]*<\/a>)(?:(?:https?|ftp|file)://|www\.|ftp\.)[-A-‌​Z0-9+&#/%=~_|$?!:,.]*[A-Z0-9+&#/%=~_|$]@i', '<a href="\0" target="_blank">\0</a>'],
        'bold'                  => ['/(\*\*|__)(.*?)\1/', '<strong>\2</strong>'],            // bold
        'emphasis'              => ['/(\*|_)(.*?)\1/', '<em>\2</em>'],                       // emphasis
        'del'                   => ['/\~\~(.*?)\~\~/', '<del>\1</del>'],                     // del
        'quote'                 => ['/\:\"(.*?)\"\:/', '<q>\1</q>'],                         // quote
        'inline code'           => ['/`(.*?)`/', '<code>\1</code>'],                         // inline code
        'ul lists'              => ['/\n\*(.*)/', 'self::ul_list'],                          // ul lists
        'ol lists'              => ['/\n[0-9]+\.(.*)/', 'self::ol_list'],                    // ol lists
        'blockquotes'           => ['/\n(&gt;|\>)(.*)/', 'self::blockquote'],               // blockquotes
        'horizontal rule'       => ['/\n-{5,}/', "\n<hr />"],                                // horizontal rule
        'add paragraphs'        => ['/\n([^\n]+)\n/', 'self::para'],                         // add paragraphs
        'fix extra ul'          => ['/<\/ul>\s?<ul>/', ''],                                  // fix extra ul
        'fix extra ol'          => ['/<\/ol>\s?<ol>/', ''],                                  // fix extra ol
        'fix extra blockquote'  => ['/<\/blockquote><blockquote>/', "\n"],                    // fix extra blockquote
    ];

    public function parseMarkdown($field)
    {
        return self::render($this->{$field});
    }

    public static function render($text)
    {
        $text = "\n".$text."\n";

        foreach (self::$rules as $name => $rule) {
            list($regex, $replacement) = $rule;

            if (is_callable($replacement)) {
                $text = preg_replace_callback($regex, $replacement, $text);
            } else {
                $text = preg_replace($regex, $replacement, $text);
            }
        }

        return trim($text);
    }

    private static function para($regs)
    {
        $line = $regs[1];
        $trimmed = trim($line);

        if (preg_match('/^<\/?(ul|ol|li|h|p|bl)/', $trimmed)) {
            return "\n".$line."\n";
        }

        return sprintf("\n<p>%s</p>\n", $trimmed);
    }

    private static function ul_list($regs)
    {
        $item = $regs[1];

        return sprintf("\n<ul>\n\t<li>%s</li>\n</ul>", trim($item));
    }

    private static function ol_list($regs)
    {
        $item = $regs[1];

        return sprintf("\n<ol>\n\t<li>%s</li>\n</ol>", trim($item));
    }

    private static function blockquote($regs)
    {
        $item = $regs[2];

        return sprintf("\n<blockquote>%s</blockquote>", trim($item));
    }

    private static function header($regs)
    {
        list($tmp, $chars, $header) = $regs;
        $level = strlen($chars);

        return sprintf('<h%d>%s</h%d>', $level, trim($header), $level);
    }

    /**
     * Add a rule.
     */
    public static function add_rule($name, $regex, $replacement)
    {
        self::$rules[$name] = [$regex, $replacement];
    }
}
