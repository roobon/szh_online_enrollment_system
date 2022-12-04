//JSLint Verified : Please do not commit this file without first validating it in JSLint. 
/*jslint browser: true, nomen: true, sloppy: true, white: true, newcap: true, regexp: true, bitwise : true, plusplus: true */
/*global $, console, alert, jQuery, confirm */

var Pagination = function (el, options) {
	options.labels = options.labels || {};

	var $container = $(el),
		$pagesContainer, 

		ALL = -1,
		PREVIOUS_PAGE_NUMBER = -1,
		NEXT_PAGE_NUMBER = -2,
		FIRST_PAGE_NUMBER = -3,
		LAST_PAGE_NUMBER = -4,

		isDisabled = options.isDisabled || false,
		itemsCount = options.itemsCount,
		currentPage = options.currentPage || 1, 
		pageSize = options.pageSize, 

		allPagesLabel = options.labels.all || 'All',
		firstPageLabel = options.labels.first || 'First',
		lastPageLabel = options.labels.last || 'Last',
		nextPageLabel = options.labels.next || '&raquo;',
		previousPageLabel = options.labels.previous || '&laquo;',

		init, reRenderPageNumbers, getRenderedPageNumbers, getPageNumbersToDisplay,
		getPagesCount, goNextPage, goPreviousPage, goToPage, disable, enable, getRenderedPager,
		process, getRenderedPageRange, toggleElements, onPageClick,   goToFirstPage, goToLastPage;

	init = function () {
		$container.html(getRenderedPager());
		$pagesContainer = $container.find('.pagination'); 

		toggleElements();

		$pagesContainer.on("click", "li", onPageClick); 

		process();
	};
 
	onPageClick = function () {
		var $p = $(this),
			page = $p.data('page');

		if (!isDisabled && !$p.hasClass('active')) {
			switch (page) {
				case PREVIOUS_PAGE_NUMBER:
					goPreviousPage();
					break;
				case NEXT_PAGE_NUMBER:
					goNextPage();
					break;
				case FIRST_PAGE_NUMBER:
					goToFirstPage();
					break;
				case LAST_PAGE_NUMBER:
					goToLastPage();
					break;
				default:
					goToPage(page);
					break;
			}

			toggleElements();
		}
	};

	toggleElements = function () {
		var pageCount = getPagesCount();

		$pagesContainer.find('li[data-page="' + PREVIOUS_PAGE_NUMBER + '"]').toggleClass('disabled', currentPage === 1);
		$pagesContainer.find('li[data-page="' + NEXT_PAGE_NUMBER + '"]').toggleClass('disabled', currentPage === pageCount);
		$pagesContainer.find('li[data-page="' + FIRST_PAGE_NUMBER + '"]').toggleClass('disabled', currentPage === 1);
		$pagesContainer.find('li[data-page="' + LAST_PAGE_NUMBER + '"]').toggleClass('disabled', currentPage === pageCount);
	};
 
	reRenderPageNumbers = function () {
		$pagesContainer.html(getRenderedPageNumbers());
	};

	getRenderedPager = function () { 
			return '<ul class="pagination">' + getRenderedPageNumbers() + '</ul>' ;
	};
 

	getRenderedPageNumbers = function () {
		var pageNumbers = getPageNumbersToDisplay(),
			result;

		result = '<li data-page="' + FIRST_PAGE_NUMBER + '"><a href="javascipt:void(0)"><span aria-hidden="true">' + firstPageLabel + '</span></a></li>' +
				 '<li data-page="' + PREVIOUS_PAGE_NUMBER + '"><a href="javascipt:void(0)"><span aria-hidden="true">' + previousPageLabel + '</span></a></li>';

		$.each(pageNumbers, function (i, p) {
			result += '<li data-page="' + p + '" ' + (p === currentPage ? 'class="active"' : '') + '><a href="javascipt:void(0)">' + p + '</a></li>';
		});

		result += '<li data-page="' + NEXT_PAGE_NUMBER + '"><a href="javascipt:void(0)"><span aria-hidden="true">' + nextPageLabel + '</span></a></li>' +
				  '<li data-page="' + LAST_PAGE_NUMBER + '"><a href="javascipt:void(0)"><span aria-hidden="true">' + lastPageLabel + '</span></a></li>';

		return result;
	};

	getPageNumbersToDisplay = function () {
		var pageNumbers = [],
			startFromNumber,
			pagesToShow = 5,
			i = 1,
			pageCount = getPagesCount();

		if (pageCount < 5) {
			pagesToShow = pageCount;
		}

		if (currentPage === 1 || currentPage === 2) {
			startFromNumber = 1;
		}
		else if (currentPage === pageCount) {
			startFromNumber = currentPage - (pagesToShow - 1);
		}
		else if ((pageCount - currentPage) === 1 && pageCount >= 5) {
			startFromNumber = currentPage - 3;
		}
		else {
			startFromNumber = currentPage - 2;
		}

		while (i <= pagesToShow) {
			pageNumbers.push(startFromNumber++);
			i++;
		}

		return pageNumbers;
	};

	getPagesCount = function () {
		return Math.ceil(itemsCount / pageSize);
	};

	goNextPage = function () {
		if (currentPage < getPagesCount()) {
			currentPage++;
			reRenderPageNumbers();

			process();
		}
	};

	goPreviousPage = function () {
		if (currentPage > 1) {
			currentPage--;
			reRenderPageNumbers();
			process();
		}
	};

	goToFirstPage = function() {
		if (currentPage !== 1) {
			goToPage(1);
		}
	};

	goToLastPage = function () {
		var pageCount = getPagesCount();

		if (currentPage !== pageCount) {
			goToPage(pageCount);
		}
	};

	goToPage = function (pageNumber) {
		currentPage = pageNumber;
		reRenderPageNumbers();
		process();
	};

	disable = function () {
		isDisabled = true;
		$pagesContainer.addClass('disabled'); 
	};

	enable = function () {
		isDisabled = false;
		$pagesContainer.removeClass('disabled'); 
	};

	process = function () {
		if (typeof options.onPageChange === 'function') {
			options.onPageChange({
				currentPage: currentPage,
				pageSize: pageSize
			});
		}
	};

	init();

	this.disable = disable;
	this.enable = enable;
};