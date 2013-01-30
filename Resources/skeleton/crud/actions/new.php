
    /**
     * Displays a form to create a new {{ entity }} entity.
     *
{% if 'annotation' == format %}
     * @Route("/new")
     * @Template()
{% endif %}
     */
    public function newAction()
    {
        $entity = new {{ entity_class }}();
        $form   = $this->createForm(new {{ entity_class }}Type(), $entity);

{% if 'annotation' == format %}
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
{% else %}
        return $this->render('{{ bundle }}:{{ entity|replace({'\\': '/'}) }}:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
{% endif %}
    }
