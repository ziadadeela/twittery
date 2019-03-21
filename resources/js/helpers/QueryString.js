import queryString from 'qs'

export default  {
  parse(key = null) {
    const params = queryString.parse(location.search.substring(1));
    return key ? params[key] : params
  },
  serialize(object){
    return queryString.stringify(object,{
      skipNulls:true
    })
  }
}
