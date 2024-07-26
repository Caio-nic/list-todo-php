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
  if (status === "concluded") {
    Swal.fire({
      title: "Tarefa concluída com sucesso!",
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
});
