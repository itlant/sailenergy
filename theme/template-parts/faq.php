<section class="py-5 bg-white" id="faq">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="display-5 fw-bold text-center mb-4 text-dark">
          Часто задаваемые <span class="text-teal">вопросы</span>
        </h2>
        <div class="accordion shadow-sm rounded-4 overflow-hidden border-0" id="faqAccordion">
          <?php
          $faqs = get_posts(array(
            'post_type' => 'faq',
            'posts_per_page' => -1,
            'orderby' => 'meta_value',
            'meta_key' => 'faq_order',
            'order' => 'ASC',
          ));

          if ($faqs) :
            $i = 1;
            foreach ($faqs as $faq) :
              $answer = get_field('faq_answer', $faq->ID);
          ?>
              <div class="accordion-item border-0 <?php echo $i < count($faqs) ? 'border-bottom' : ''; ?>">
                <h2 class="accordion-header" id="faqHeading<?php echo $i; ?>">
                  <button class="accordion-button fw-bold text-dark bg-white <?php echo $i > 1 ? 'collapsed' : ''; ?>"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faqCollapse<?php echo $i; ?>"
                    <?php echo $i == 1 ? 'aria-expanded="true"' : 'aria-expanded="false"'; ?>
                    aria-controls="faqCollapse<?php echo $i; ?>">
                    <?php echo get_the_title($faq); ?>
                  </button>
                </h2>
                <div id="faqCollapse<?php echo $i; ?>"
                  class="accordion-collapse collapse <?php echo $i == 1 ? 'show' : ''; ?>"
                  aria-labelledby="faqHeading<?php echo $i; ?>"
                  data-bs-parent="#faqAccordion">
                  <div class="accordion-body text-muted">
                    <?php echo $answer ?: 'Ответ на этот вопрос скоро появится.'; ?>
                  </div>
                </div>
              </div>
            <?php
              $i++;
            endforeach;
          else :
            ?>
            <div class="accordion-item border-0 border-bottom">
              <h2 class="accordion-header" id="faqHeading1">
                <button class="accordion-button fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                  Нужен ли опыт, чтобы участвовать в регате?
                </button>
              </h2>
              <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  Вовсе нет! В наших регатах участвуют как профессионалы, так и новички. На каждой яхте есть профессиональный шкипер, который объяснит задачи.
                </div>
              </div>
            </div>
            <div class="accordion-item border-0 border-bottom">
              <h2 class="accordion-header" id="faqHeading2">
                <button class="accordion-button fw-bold text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                  Что входит в стоимость обучения на шкипера?
                </button>
              </h2>
              <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  Проживание на яхте в течение 14 дней, практические занятия с инструктором, учебные материалы, итоговый экзамен и получение международного сертификата.
                </div>
              </div>
            </div>
            <div class="accordion-item border-0">
              <h2 class="accordion-header" id="faqHeading3">
                <button class="accordion-button fw-bold text-dark bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                  Как арендовать яхту после обучения?
                </button>
              </h2>
              <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                <div class="accordion-body text-muted">
                  После получения сертификата Bareboat Skipper вы можете арендовать яхту в любой чартерной компании в Турции, Греции, Хорватии и других странах.
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>