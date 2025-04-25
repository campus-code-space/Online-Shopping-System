import React from 'react'
import { Link } from 'react-router-dom'
function CategoryItem({ item, sub }) {
    return (
        <li className='group relative'>
            <Link to={`/${item}`} className="p-1.5 text-gray-600 hover:text-green-600">{item}</Link>
            <ul className='hidden absolute z-10 group-hover:flex bg-white w-30 mt-3 rounded-2xl p-4'>
                {sub.map((item, index) => {
                    return <li key={index}>{item}</li>
                })}
            </ul>
        </li>
    )
}

export default CategoryItem