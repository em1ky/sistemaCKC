<?php

class SiteUsuarioController extends RenderView
{
    public function index()
    {
        $this->carregarView('home');
    }

    public function historia()
    {
        $this->carregarView('historia');
    }
}