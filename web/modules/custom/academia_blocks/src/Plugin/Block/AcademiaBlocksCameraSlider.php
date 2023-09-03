<?php

/*
 * Here comes the text of your license
 * Each line should be prefixed with  * 
 */

namespace Drupal\academia_blocks\Plugin\Block;

/**
 * Description of AcademiaBlocksCameraSlider
 *
 * @author anup
 */
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\file\Entity\File;
use Drupal\Core\Url;

/**
 * Provides a block that has custom configuration option.
 *
 * @Block(
 *   id = "academia_blocks_camera_slider_block",
 *   admin_label = @Translation("Camera slider"),
 *   category = "AcademiaBlocks"
 * )
 */
class AcademiaBlocksCameraSlider extends BlockBase {

    private $slider_content_type = 'content_slider';

    /**
     * {@inheritdoc}
     */
    public function build(): array {


        $slides = $this->getSlides();

        return [
            '#theme' => 'camera_slide_block',
            '#slides' => $slides,
            '#attached' => [
                'library' => [
                    'academia_blocks/js_lib',
                    'academia_blocks/css_lib',
                ],
            ],
        ];
    }

    private function getSlides() {
        $slides = \Drupal::entityTypeManager()
                ->getStorage('node')
                ->loadByProperties([
            'status' => '1',
            'type' => $this->slider_content_type,
        ]);
        $nodedata = [];
        if ($slides) {
            /*
              Get the details of each node and
              put it in an array.
              We have to do this because we need to manipulate the array so that it will spit out exactly the XML we want
             */
            foreach ($slides as $node) {

                $file_uri = ($node->get('field_slider_image')->entity) ? $node->get('field_slider_image')->entity->getFileUri() : null;
                //$file_src = ($file_uri) ? Url::fromUri(file_create_url($file_uri))->toString() : null;
                $slide = [];
                $slide['title'] = $node->get('title')->value;
                $slide['caption'] = $node->get('field_slide_captions')->value;
                $slide['link'] = $node->get('field_slide_link')->uri;
                $slide['video_url'] = $node->get('field_video_url')->uri;
                $slide['image_src'] = $file_uri;
                $nodedata[] = $slide;
            }
        }
        return $nodedata;
    }
}
