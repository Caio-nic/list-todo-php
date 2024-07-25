document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get("status");
  const deleteForms = document.querySelectorAll(".delete-form");

  if (status === "success") {
    Swal.fire({
      title: "Tarefa criada com sucesso!",
      icon: "success",
      width: 600,
      padding: "3em",
      color: "#716add",
      background:
        "#fff url(https://sweetalert2.github.io/#examplesimages/trees.png)",
      backdrop: `
              rgba(0,0,123,0.4)
              url("https://sweetalert2.github.io/#examplesimages/nyan-cat.gif")
              left top
              no-repeat
          `,
    }).then(() => {
      window.location.href = "/";
    });
  }
  deleteForms.forEach((form) => {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      Swal.fire({
        title: "Você tem certeza?",
        text: "Esta ação não pode ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          console.log("Formulário confirmado. Enviando...");
          form.submit();
        } else {
          console.log("Exclusão cancelada.");
        }
      });
    });
  });
});
