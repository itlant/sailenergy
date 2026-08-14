<div class="modal fade" id="callbackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-dark-custom text-white border-0 p-4">
        <h5 class="modal-title fw-bold">Записаться на курс</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="#" method="POST">
          <div class="mb-3">
            <label for="modalName" class="form-label fw-medium">Ваше имя</label>
            <input type="text" class="form-control p-3 bg-light border-0" id="modalName" placeholder="Иван Иванов" required>
          </div>
          <div class="mb-3">
            <label for="modalPhone" class="form-label fw-medium">Телефон</label>
            <input type="tel" class="form-control p-3 bg-light border-0" id="modalPhone" placeholder="+7 (999) 999-99-99" required>
          </div>
          <div class="mb-4">
            <label for="modalCourse" class="form-label fw-medium">Интересующий курс</label>
            <select class="form-select p-3 bg-light border-0" id="modalCourse">
              <option selected value="">Выберите...</option>
              <option value="crew">Матрос (International Crew)</option>
              <option value="skipper">Шкипер (Bareboat Skipper)</option>
              <option value="yachtmaster">Капитан (Yachtmaster)</option>
            </select>
          </div>
          <button type="submit" class="btn btn-teal w-100 py-3 fw-bold rounded-3">Отправить заявку</button>
        </form>
      </div>
    </div>
  </div>
</div>