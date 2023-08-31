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
                //$slide = $node->toArray();
                //$midea_id = !empty($slide['field_slider_image']) ? $slide['field_slider_image'][0]['target_id'] : null;
                $slide = [];
                $slide['title'] = $node->get('title')->getValue();
                $nodedata[] = $slide;
            }
        }
        return $nodedata;
    }
}
