<?php declare(strict_types=1);

namespace Pich\App\Response;

use Twig_Environment;

class Http implements ResponseInterface
{
    /**
     * @var Twig_Environment
     */
    private $twig;
    /**
     * @var string
     */
    private $template;
    /**
     * @var array
     */
    private $data = [];

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function render(): string
    {
        return $this->twig->render($this->template, $this->data);
    }
}
