const table = document.querySelector('.responsive-table');
const headTitles = Array.from(table.querySelectorAll('.responsive-table__head__title'));
const bodyTexts = Array.from(table.querySelectorAll('.responsive-table__body__text'));

bodyTexts.forEach((bodyText, index) => {
  const title = headTitles[index % headTitles.length].innerText;
  bodyText.setAttribute('data-title', title);
});
