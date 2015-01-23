<?php

namespace Colzak\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
	public function listAlbumAction() {
		return $this->render('ColzakBlogBundle:Media:list_album.html.twig');
	}
}
