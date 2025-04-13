

export const getUserRole = ()=>{
    let userdata = JSON.parse(localStorage.getItem('userdata'));
    let role = null;
    return (userdata['role'])?userdata['role']:role;
}

export const getUserToken = ()=>{
    let userdata = JSON.parse(localStorage.getItem('userdata'));
    let token = null;
    return (userdata['token'])?userdata['token']:token;
}

// module.exports = {getUserRole,getUserToken};