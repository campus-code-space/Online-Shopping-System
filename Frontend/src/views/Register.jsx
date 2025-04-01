import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { ArrowLeft } from 'lucide-react';
import { Eye, EyeOff } from "lucide-react";

export default function Register() {
  const [full_name, setFullName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [password_confirmation, setPasswordConfirmation] = useState('');

  const [phone_number, setPhoneNumber] = useState();
  const [fayda_number, setFaydaNumber] = useState();
  const [role, setRole] = useState();
  const [address, setAddress] = useState('');
  const [delivery_mode, setDeliveryMode] = useState('');
  const [profile_image, setProfileImage] = useState('');
  const [identity_card_image, setIDImage] = useState('');

  const [showPassword, setShowPassword] = useState(false);
  const [showPasswordConfirmation, setShowPasswordConfirmation] = useState(false);
  const [error, setError] = useState("password mismatch");
  
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    // In a real app, you would create the account here
    navigate('/dashboard');
  };

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div className="sm:mx-auto sm:w-full sm:max-w-md">
        <Link to="/" className="flex items-center text-green-600 hover:text-green-700 mb-6 mx-4">
          <ArrowLeft className="h-5 w-5 mr-2" />
          Back to Home
        </Link>
        <h2 className="text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          Already have an account?{' '}
          <Link to="/signin" className="font-medium text-green-600 hover:text-green-500">
            Sign in
          </Link>
        </p>
      </div>

      <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div className="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form className="space-y-6" onSubmit={handleSubmit}>

            {/* Full Name */}
            <div>
              <label htmlFor="full_name" className="block text-sm font-medium text-gray-700">
                Full Name
              </label>
              <div className="mt-1">
                <input
                  id="full_name"
                  name="full_name"
                  type="text"
                  autoComplete="full_name"
                  required
                  value={full_name}
                  onChange={(e) => setFullName(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
            </div>


            {/* Email */}
            <div>
              <label htmlFor="email" className="block text-sm font-medium text-gray-700">
                Email address
              </label>
              <div className="mt-1">
                <input
                  id="email"
                  name="email"
                  type="email"
                  autoComplete="email"
                  required
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
            </div>


            {/* Phone Number */}
            <div>
              <label htmlFor="phone_number" className="block text-sm font-medium text-gray-700">
                Phone Number
              </label>
              <div className="mt-1">
                <input
                  id="phone_number"
                  name="phone_number"
                  type="tel"
                  autoComplete="phone_number"
                  required
                  value={phone_number}
                  onChange={(e) => setPhoneNumber(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
            </div>

            {/* Role */}
            <div>
              <label htmlFor="role" className="block text-sm font-medium text-gray-700">
                Role
              </label>
              <div className="mt-1">
                <select name="role" id="role"  
                        onChange={(e) => setRole(e.target.value)}
                        className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                  >
                  <option value="">Selecct Option</option>
                  <option value="vendor">Vendor</option>
                  <option value="customer">Customer</option>
                  <option value="delivery_agent">Delivery Agent</option>
                  <option value="admin">Admin</option>
                </select>
              </div>
            </div>


            {/* Fayda ID Number */}
            {role != "vendor" && (
              <div>
              <label htmlFor="fayda_number" className="block text-sm font-medium text-gray-700">
                Fayda ID Number
              </label>
              <div className="mt-1">
                <input
                  id="fayda_number"
                  name="fayda_number"
                  type="number"
                  autoComplete="fayda_number"
                  required
                  value={fayda_number}
                  onChange={(e) => setFaydaNumber(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
            </div>
            )}
            
            {/* Address */}
            <div>
              <label htmlFor="address" className="block text-sm font-medium text-gray-700">
                Address
              </label>
              <div className="mt-1">
                <input
                  id="address"
                  name="address"
                  type="text"
                  autoComplete="address"
                  required
                  value={address}
                  onChange={(e) => setAddress(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
              <div>
                <span className="text-gray-500 italic bg-transparent">Format: city/region, subcity, wereda</span>
              </div>
            </div>

            
            {/* Delivery Mode */}
            {role === "delivery_agent" && (
              <div className="mt-4">
                <label htmlFor="delivery_mode" className="block text-sm font-medium text-gray-700">
                  Delivery Mode
                </label>
                <div className="mt-1">
                  <select
                    name="delivery_mode"
                    id="delivery_mode"
                    onChange={(e) => setDeliveryMode(e.target.value)}
                    className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-gray-700 focus:outline-none focus:ring-green-500 focus:border-green-500 pr-8"
                  >
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                    <option value="motor_bike">Motor Bike</option>
                  </select>
                </div>
              </div>
            )}

            {/* Profile Image */}
            <div>
              <label htmlFor="profile_image" className="block text-sm font-medium text-gray-700">
                Profile Image
              </label>
              <div className="mt-1">
                <input
                  id="profile_image"
                  name="profile_image"
                  type="file"
                  autoComplete="profile_image"
                  // required
                  value={profile_image}
                  onChange={(e) => setProfileImage(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
            </div>

            {/* Profile Image */}
            <div>
              <label htmlFor="identity_card_image" className="block text-sm font-medium text-gray-700">
                Identity Card Image
              </label>
              <div className="mt-1">
                <input
                  id="identity_card_image"
                  name="identity_card_image"
                  type="file"
                  autoComplete="identity_card_image"
                  // required
                  value={identity_card_image}
                  onChange={(e) => setIDImage(e.target.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                />
              </div>
            </div>
            
            {/* Password */}
            <div>
              <label
                htmlFor="password"
                className="block text-sm font-medium text-gray-700"
              >
                Password
              </label>
              <div className="mt-1 flex items-center border border-gray-300 rounded-md shadow-sm focus-within:ring-green-500 focus-within:border-green-500">
                <input
                  id="password"
                  name="password"
                  type={showPassword ? "text" : "password"}
                  autoComplete="password"
                  required
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="appearance-none flex-1 px-3 py-2 placeholder-gray-400 focus:outline-none border-none"
                />
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="px-3 py-2 text-gray-600 hover:text-gray-900 transition"
                >
                  {showPassword ? <EyeOff size={20} /> : <Eye size={20} />}
                </button>
              </div>
            </div>

            {/* Password Confirmation */}
            <div>
              <label
                htmlFor="password_confirmation"
                className="block text-sm font-medium text-gray-700"
              >
                Confirm Password
              </label>
              <div className="mt-1 flex items-center border border-gray-300 rounded-md shadow-sm focus-within:ring-green-500 focus-within:border-green-500">
                <input
                  id="password_confirmation"
                  name="password_confirmation"
                  type={showPasswordConfirmation ? "text" : "password"}
                  autoComplete="password"
                  required
                  value={password_confirmation}
                  onChange={(e) => setPasswordConfirmation(e.target.value)}
                  className="appearance-none flex-1 px-3 py-2 placeholder-gray-400 focus:outline-none border-none"
                />
                <button
                  type="button"
                  onClick={() => setShowPasswordConfirmation(!showPasswordConfirmation)}
                  className="px-3 py-2 text-gray-600 hover:text-gray-900 transition"
                >
                  {showPasswordConfirmation ? <EyeOff size={20} /> : <Eye size={20} />}
                </button>
              </div>
                {password !== password_confirmation && <p className="text-red-500 text-sm mt-1 italic">{error}</p>}
            </div>

            <div>
              <button 
                type="submit"
                disabled={password !== password_confirmation}
                className={`px-4 py-2 mt-3 text-white bg-green-500 rounded-md 
                            ${password !== password_confirmation ? "opacity-50 cursor-not-allowed" : "hover:bg-green-600"}`}
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}