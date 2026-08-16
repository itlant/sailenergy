<?php

/**
 * Template Name: Страница в разработке html
 */
?>

<!doctype html>
<html lang="ru-RU">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SAIL ENERGY — Скоро открытие</title>

  <!-- Шрифт Rubik (как на основном сайте) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <style>
    /* ----- Сброс и базовые стили ----- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Rubik", sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #0b1a2b;
      /* глубокий тёмно-синий, как море ночью */
      color: #ffffff;
      margin: 0;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    /* ----- Анимированный фон "Волны" ----- */
    body::before {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background:
        radial-gradient(circle at 20% 80%,
          rgba(30, 144, 255, 0.15) 0%,
          transparent 50%),
        radial-gradient(circle at 80% 20%,
          rgba(0, 191, 255, 0.1) 0%,
          transparent 50%);
      z-index: 0;
      animation: pulseGlow 6s ease-in-out infinite alternate;
    }

    @keyframes pulseGlow {
      0% {
        opacity: 0.6;
      }

      100% {
        opacity: 1;
      }
    }

    /* ----- Парусник (CSS-арт) ----- */
    .sailboat {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1;
      opacity: 0.25;
      animation: floatBoat 8s ease-in-out infinite;
    }

    @keyframes floatBoat {

      0%,
      100% {
        transform: translateX(-50%) translateY(0px) rotate(-2deg);
      }

      50% {
        transform: translateX(-50%) translateY(-15px) rotate(2deg);
      }
    }

    /* ----- Центральный контейнер ----- */
    .coming-soon {
      position: relative;
      z-index: 2;
      text-align: center;
      max-width: 700px;
      width: 100%;
      padding: 40px 30px;
      background: rgba(11, 26, 43, 0.75);
      backdrop-filter: blur(8px);
      border-radius: 32px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
      animation: fadeInUp 1.2s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ----- Логотип (текстовый) ----- */
    .logo {
      font-size: 3.2rem;
      font-weight: 700;
      letter-spacing: 4px;
      background: linear-gradient(135deg, #f0f9ff 0%, #7dd3fc 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 12px;
      display: inline-block;
    }

    .logo span {
      font-weight: 300;
      background: none;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.3);
      color: rgba(255, 255, 255, 0.3);
      font-size: 0.5em;
      vertical-align: super;
      margin-left: -6px;
    }

    /* ----- Основной текст ----- */
    .title {
      font-size: 1.8rem;
      font-weight: 500;
      margin: 20px 0 12px;
      color: #ffffff;
    }

    .title .wave {
      display: inline-block;
      animation: waveHand 2.5s infinite;
      transform-origin: 70% 70%;
    }

    @keyframes waveHand {
      0% {
        transform: rotate(0deg);
      }

      10% {
        transform: rotate(14deg);
      }

      20% {
        transform: rotate(-8deg);
      }

      30% {
        transform: rotate(14deg);
      }

      40% {
        transform: rotate(-4deg);
      }

      50% {
        transform: rotate(10deg);
      }

      60%,
      100% {
        transform: rotate(0deg);
      }
    }

    .subtitle {
      font-size: 1.1rem;
      font-weight: 300;
      color: rgba(255, 255, 255, 0.7);
      line-height: 1.6;
      margin-bottom: 32px;
    }

    .subtitle strong {
      color: #7dd3fc;
      font-weight: 500;
    }

    /* ----- Кнопки соцсетей ----- */
    .social-links {
      display: flex;
      justify-content: center;
      gap: 16px;
      flex-wrap: wrap;
      margin: 10px 0 5px;
    }

    .social-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 28px;
      border-radius: 60px;
      font-family: "Rubik", sans-serif;
      font-weight: 500;
      font-size: 1rem;
      color: #ffffff;
      text-decoration: none;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.15);
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(4px);
      letter-spacing: 0.3px;
    }

    .social-btn:hover {
      transform: translateY(-4px) scale(1.02);
      box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.6);
    }

    .social-btn.vk {
      background: rgba(69, 138, 255, 0.2);
      border-color: rgba(69, 138, 255, 0.4);
    }

    .social-btn.vk:hover {
      background: #458aff;
      border-color: #458aff;
    }

    .social-btn.tg {
      background: rgba(0, 136, 204, 0.2);
      border-color: rgba(0, 136, 204, 0.4);
    }

    .social-btn.tg:hover {
      background: #0088cc;
      border-color: #0088cc;
    }

    .social-btn svg {
      width: 22px;
      height: 22px;
      fill: currentColor;
      flex-shrink: 0;
    }

    /* ----- Email для связи ----- */
    .contact-email {
      margin-top: 32px;
      font-size: 0.95rem;
      color: rgba(255, 255, 255, 0.4);
    }

    .contact-email a {
      color: rgba(255, 255, 255, 0.7);
      text-decoration: none;
      border-bottom: 1px dotted rgba(255, 255, 255, 0.2);
      transition: color 0.3s;
    }

    .contact-email a:hover {
      color: #7dd3fc;
      border-bottom-color: #7dd3fc;
    }

    /* ----- Адаптивность ----- */
    @media (max-width: 600px) {
      .logo {
        font-size: 2.4rem;
        letter-spacing: 2px;
      }

      .title {
        font-size: 1.4rem;
      }

      .subtitle {
        font-size: 0.95rem;
      }

      .social-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
        width: 100%;
        justify-content: center;
      }

      .social-links {
        flex-direction: column;
        align-items: center;
      }

      .coming-soon {
        padding: 30px 20px;
        border-radius: 24px;
      }

      .sailboat {
        display: none;
      }
    }

    @media (max-width: 400px) {
      .logo {
        font-size: 2rem;
      }

      .title {
        font-size: 1.2rem;
      }
    }
  </style>
</head>

<body>
  <!-- Декоративный парусник (CSS) -->
  <div class="sailboat" aria-hidden="true">
    <svg
      width="120"
      height="80"
      viewBox="0 0 120 80"
      fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <path
        d="M20 70 L60 10 L100 70"
        stroke="rgba(255,255,255,0.3)"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round" />
      <path
        d="M20 70 L60 30 L100 70"
        stroke="rgba(255,255,255,0.15)"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round" />
      <line
        x1="15"
        y1="70"
        x2="105"
        y2="70"
        stroke="rgba(255,255,255,0.4)"
        stroke-width="3"
        stroke-linecap="round" />
      <line
        x1="60"
        y1="10"
        x2="60"
        y2="70"
        stroke="rgba(255,255,255,0.2)"
        stroke-width="2"
        stroke-linecap="round" />
      <!-- волна -->
      <path
        d="M0 74 Q15 66 30 74 Q45 82 60 74 Q75 66 90 74 Q105 82 120 74"
        stroke="rgba(255,255,255,0.1)"
        stroke-width="2"
        fill="none" />
    </svg>
  </div>

  <!-- Основной контент -->
  <div class="coming-soon">
    <!-- Логотип -->
    <div class="logo">SAIL<span>ENERGY</span></div>

    <!-- Заголовок -->
    <h1 class="title"><span class="wave">👋</span> Скоро открытие!</h1>

    <!-- Описание -->
    <p class="subtitle">
      Мы готовим для вас <strong>новый сайт</strong> о парусном спорте,
      регатах и приключениях.<br />
      А пока — присоединяйтесь к нашему сообществу в соцсетях:
    </p>

    <!-- Кнопки соцсетей -->
    <div class="social-links">
      <a
        href="#"
        class="social-btn vk"
        target="_blank"
        rel="noopener noreferrer">
        <svg viewBox="0 0 24 24">
          <path
            d="M12.365 17.75c-4.416 0-6.96-3.032-7.08-8.08h2.5c.088 3.744 1.808 5.328 3.168 5.656V9.67h2.208v3.224c1.344-.144 2.752-1.616 3.232-3.224h2.208c-.368 2.064-1.904 3.536-2.992 4.128 1.088.512 2.848 1.856 3.52 4.128h-2.56c-.672-1.312-1.872-2.336-3.472-2.48v2.48h-.288z" />
        </svg>
        VKontakte
      </a>
      <a
        href="#"
        class="social-btn tg"
        target="_blank"
        rel="noopener noreferrer">
        <svg viewBox="0 0 24 24">
          <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.1-.2-.11-.06-.27-.04-.38-.02-.16.02-2.65 1.68-2.65 1.68l-3.02-2.03c-.34-.23-.73-.48-.01-.77 2.46-1.07 4.43-1.76 5.93-2.08 2.82-.6 3.41-.4 3.79-.24.4.16.63.56.63.56s-.02.16-.05.3z" />
        </svg>
        Telegram
      </a>
    </div>

    <!-- Email -->
    <div class="contact-email">
      По вопросам: <a href="mailto:info@sailenergy.ru">info@sailenergy.ru</a>
    </div>
  </div>
</body>

</html>