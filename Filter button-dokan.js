function insertMobileFilterToggle() {
  if (window.innerWidth >= 768) return;

  const title = document.querySelector('h1.woocommerce-products-header__title');
  const filterWrap = document.querySelector('.wpc-filters-main-wrap');

  // Retry logic to wait for DOM to settle
  if (!title || !filterWrap) {
    setTimeout(insertMobileFilterToggle, 200); // Try again after 200ms
    return;
  }

  // Prevent duplicate toggle button
  if (!document.querySelector('.mobile-filter-toggle')) {
    const toggleBtn = document.createElement('button');
    toggleBtn.className = 'mobile-filter-toggle';
    toggleBtn.textContent = 'Show Filters';

    title.insertAdjacentElement('afterend', toggleBtn);
    title.insertAdjacentElement('afterend', filterWrap);

    filterWrap.style.display = 'none';

    toggleBtn.addEventListener('click', function () {
      const isOpen = filterWrap.style.display === 'block';
      filterWrap.style.display = isOpen ? 'none' : 'block';
      toggleBtn.textContent = isOpen ? 'Show Filters' : 'Hide Filters';
    });
  }
}

// Run on page load
document.addEventListener('DOMContentLoaded', insertMobileFilterToggle);

// Retry after AJAX filter event
document.addEventListener('wpc_ajax_complete', function () {
  setTimeout(insertMobileFilterToggle, 300); // Give time for full DOM re-render
});
