
let userdata = localStorage.getItem('userdata');
const getUserRole = ()=>{
    let role = null;
    return (userdata['role'])?userdata['role']:role;
}

const getUserToken = ()=>{
    let token = null;
    return (userdata['token'])?userdata['token']:token;
}

module.exports = {getUserRole,getUserToken};