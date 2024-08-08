/*
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 * Author: BeDigit | https://bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - https://codecanyon.net/licenses/standard
 */

/**
 * Make an HTTP request
 *
 * Call the function and output value or error message to console
 * httpRequest()
 *   .then((result) => console.log(result))
 *   .catch((error) => console.error(error));
 *
 * @param method
 * @param url
 * @param data
 * @param headers
 * @returns {Promise<any>}
 */
async function httpRequest(method, url = "", data = {}, headers = {}) {
	const readableRequestMethods = ['GET', 'HEAD'];
	const nonCacheableRequestMethods = ['POST', 'PUT', 'DELETE', 'PATCH', 'CREATE', 'UPDATE'];
	
	method = method.toUpperCase();
	
	/* HTTP Client default headers for API calls */
	let defaultHeaders = {
		'X-Requested-With': 'XMLHttpRequest',
		'Content-Type': 'application/json',
	};
	/* Ajax's calls should always have the CSRF token attached to them; otherwise they won't work */
	let csrfTokenEl = document.querySelector('meta[name="csrf-token"]');
	if (isElDefined(csrfTokenEl)) {
		let token = csrfTokenEl.getAttribute('content');
		if (token) {
			defaultHeaders['X-CSRF-TOKEN'] = token;
		}
	}
	headers = {...defaultHeaders, ...headers};
	
	/* Cache */
	let cache = 'default';
	if (nonCacheableRequestMethods.includes(method)) {
		cache = 'no-cache';
	}
	
	/* Request Options */
	let options = {
		method: method, // *GET, POST, PUT, DELETE, etc.
		mode: 'cors', // no-cors, *cors, same-origin
		cache: cache, // *default, no-cache, reload, force-cache, only-if-cached
		credentials: 'same-origin', // include, *same-origin, omit
		headers: headers,
		redirect: 'follow', // manual, *follow, error
		referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
		body: !isEmpty(data) ? JSON.stringify(data) : {}, // body data type must match "Content-Type" header
	};
	
	/* Set the body parameter related to request method */
	if (readableRequestMethods.includes(method)) {
		delete options.body;
	}
	
	/* Fetch Request */
	try {
		const response = await fetch(url, options);
		const json = await response.json();
		
		if (!response.ok) {
			let defaultMessage = "Network response was not OK";
			let message = getErrorMessageFromJson(json, defaultMessage);
			throwError(new Error(message));
		}
		
		return json;
	} catch (error) {
		throwError(error); // re-throw the error unchanged
	}
}

/**
 * Stop the code execution with "new Error(errorMessage)" by throwing the error message
 * @param error
 */
function throwError(error) {
	throw error;
}
