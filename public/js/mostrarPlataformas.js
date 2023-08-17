/**
 * Description
 * @param {const} div_todos
 * @param {const} btn_todos
 * @param {const} btn_activos
 * @param {const} div_activo
 * @param {const} btn_inactivos
 * @param {const} div_inactivo
 * @returns {any}
 */
$(document).ready(function () {
  const div_todos = document.getElementById("div_todos");
  const btn_todos = document.getElementById("btn_todos");
  const btn_activos = document.getElementById("btn_activos");
  const div_activo = document.getElementById("div_activo");
  const btn_inactivos = document.getElementById("btn_inactivos");
  const div_inactivo = document.getElementById("div_inactivo");
});

btn_todos.addEventListener("click", function () {
  btn_todos.style.display = "none";
  btn_activos.style.display = "inline";
  btn_inactivos.style.display = "inline";
  div_todos.style.display = "inline";
  div_activo.style.display = "none";
  div_inactivo.style.display = "none";
});

btn_activos.addEventListener("click", function () {
  btn_todos.style.display = "inline";
  btn_activos.style.display = "none";
  btn_inactivos.style.display = "inline";
  div_todos.style.display = "none";
  div_activo.style.display = "inline";
  div_inactivo.style.display = "none";
});

btn_inactivos.addEventListener("click", function () {
  btn_todos.style.display = "inline";
  btn_activos.style.display = "inline";
  btn_inactivos.style.display = "none";
  div_todos.style.display = "none";
  div_activo.style.display = "none";
  div_inactivo.style.display = "inline";
});
