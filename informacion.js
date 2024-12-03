document.addEventListener("DOMContentLoaded", function() {
  var informations = [
    { title: "DESINTERES POR EL MEDIO AMBIENTE", content: "Aunque el impacto de la protección ambiental afecta directamente la calidad de vida de las personas, el problema subyacente es una apatía generalizada hacia la protección ambiental. Esta apatía puede atribuirse tanto a la falta de información sobre cuestiones ambientales actuales como al desinterés. Se deben crear formas simples y efectivas para motivar a las personas a tomar medidas de conservación en su vida diaria, ya sea el uso racional de recursos como el agua y la electricidad." },
    { title: "NUESTRO BENEFICIO COMO INSENTIVO", content: "A través de encuestas realizadas a una muestra selecta de la población, se ha llegado a la conclusión de que, al enfrentarse a actividades que pueden carecer de entretenimiento pero son indispensables, el conocimiento de los beneficios derivados de su realización sirve como un poderoso incentivo. Por ejemplo, en el caso del ejercicio físico, el saber la cantidad de calorías quemadas, o en el ámbito académico, la adquisición de conocimientos derivados del estudio, son ejemplos claros de cómo el entendimiento de los beneficios obtenidos puede impulsar la participación en estas actividades." },
    { title: "ECO MONEY", content: "En respuesta a la urgente situación ambiental global, nació ECO MONEY, una aplicación revolucionaria que brinda a los usuarios incentivos financieros para participar activamente en la protección del medio ambiente." },
    { title: "", content: "ECO MONEY es una aplicación innovadora diseñada para proporcionar a los usuarios cálculos precisos de ahorro financiero basados en datos específicos ingresados durante un período de tiempo. Esta herramienta le permite visualizar los ahorros financieros potenciales que se pueden lograr implementando medidas de ahorro de recursos. Además, la aplicación proporciona instrucciones detalladas sobre los pasos que se pueden tomar para reducir el consumo de diversos recursos en la vida diaria." },
    { title: "", content: "Por ejemplo, medidas como la reducción del consumo de agua, la optimización del consumo de electricidad y otras prácticas respetuosas con el medio ambiente se presentan de forma clara y fácil de entender en ECO MONEY, lo que permite a los usuarios tomar decisiones informadas y promover el ahorro financiero y la protección del medio ambiente." }
  ];
  var currentInfoIndex = 0;

  function showInfo(index) {
    var infoTitle = document.getElementById("info-title");
    var infoContent = document.getElementById("info-content");
    infoTitle.textContent = informations[index].title;
    infoContent.textContent = informations[index].content;

    var nextButton = document.getElementById('next-button');
    var continueButton = document.getElementById('continue-button');
    if (index === informations.length - 1) {
      nextButton.style.display = 'none';
      continueButton.style.display = 'inline';
    } else {
      nextButton.style.display = 'inline';
      continueButton.style.display = 'none';
    }
  }

  showInfo(currentInfoIndex);

  document.getElementById('back-button').addEventListener('click', function() {
    currentInfoIndex--;
    if (currentInfoIndex < 0) {
      currentInfoIndex = informations.length - 1;
    }
    showInfo(currentInfoIndex);
  });

  document.getElementById('next-button').addEventListener('click', function() {
    currentInfoIndex++;
    if (currentInfoIndex >= informations.length) {
      currentInfoIndex = 0;
    }
    showInfo(currentInfoIndex);
  });

  document.getElementById('continue-button').addEventListener('click', function() {
    window.location.href = 'menu.html';
  });

  var carouselItems = document.querySelectorAll('.carousel-item');
  var currentCarouselIndex = 0;

  function showCarouselItem(index) {
    carouselItems.forEach(function(item, idx) {
      if (idx === index) {
        item.classList.add('active');
      } else {
        item.classList.remove('active');
      }
    });
  }

  setInterval(function() {
    currentCarouselIndex++;
    if (currentCarouselIndex >= carouselItems.length) {
      currentCarouselIndex = 0;
    }
    showCarouselItem(currentCarouselIndex);
  }, 3000);

  showCarouselItem(currentCarouselIndex);
});
