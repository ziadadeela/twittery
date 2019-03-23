/**
 * Overrides some default values when sending a server request
 */
import axios from 'axios';

export const $httpRequester = axios.create();
