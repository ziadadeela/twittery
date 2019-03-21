import {$httpRequester} from '../../httpRequester';
import queryString from '../../helpers/QueryString'

export const get = (params = {}) => {
  return $httpRequester.get(`users?${queryString.serialize(params)}`)
};


export const getAuth = (params = {}) => {
    return $httpRequester.get(`user`)
};


export const update = (id,params) => {
  if(params instanceof FormData){
    params.append('_method', 'put')
  }else if(params){
    params._method = 'put'
  }
  return $httpRequester.post(`users/${id}`, params, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })
};
export const create = (params = {}) => {
  return $httpRequester.post(`users`, params, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })
};
