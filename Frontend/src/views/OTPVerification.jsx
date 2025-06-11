import React, { useState, useEffect } from 'react';
import { ToastContainer, toast } from 'react-toastify';
import { Link, useLocation, useNavigate } from 'react-router-dom';
import { ArrowLeft } from 'lucide-react';
import axios from 'axios';

export default function OTPVerification() {
  const [otp, setOtp] = useState('');
  const location = useLocation();
  const navigate = useNavigate();
  const { email, isSignup } = location.state || {};
  const tempUserData = JSON.parse(localStorage.getItem('tempUserData')) || {};

  useEffect(() => {
    if (!email) {
      toast.error('No email provided. Redirecting to sign-in.', {
        position: 'top-center',
        autoClose: 3000,
        theme: 'light',
      });
      setTimeout(() => navigate('/signin'), 3000);
    }
  }, [email, navigate]);

  const handleChange = (e) => {
    const value = e.target.value.replace(/\D/g, '');
    if (value.length <= 4) setOtp(value); // 4-digit OTP as per backend
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (otp.length !== 4) {
      toast.error('Please enter a 4-digit OTP.', {
        position: 'top-center',
        autoClose: 5000,
        theme: 'light',
      });
      return;
    }
    try {
      let response;
      if (isSignup) {
        // Verify OTP and create user
        response = await axios.post('http://localhost:8000/api/verify-and-create-user', {
          ...tempUserData,
          email,
          otp,
        });
        localStorage.removeItem('tempUserData'); // Clear temp data after use
      } else {
        // Verify OTP for login (if implemented)
        response = await axios.post('http://localhost:8000/api/verify-otp', { email, otp });
      }
      if (response.data.status) {
        localStorage.setItem('userdata', JSON.stringify(response.data.data));
        toast.success(`${response.data.message}`, {
          position: 'top-center',
          autoClose: 5000,
          theme: 'light',
        });
        const role = JSON.parse(localStorage.getItem('userdata')).role;
        setTimeout(() => {
          switch (role) {
            case 'User':
              navigate('/dashboard');
              break;
            case 'Vendor':
              navigate('/vendor-management');
              break;
            default:
              navigate('/');
          }
        }, 2000);
      } else {
        toast.error(`${response.data.message}`, {
          position: 'top-center',
          autoClose: 5000,
          theme: 'light',
        });
      }
    } catch (err) {
      console.log(err);
      toast.error('An error occurred. Please try again.', {
        position: 'top-center',
        autoClose: 5000,
        theme: 'light',
      });
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <ToastContainer />
      <div className="sm:mx-auto sm:w-full sm:max-w-md">
        <Link to={isSignup ? '/signup' : '/signin'} className="flex items-center text-green-600 hover:text-green-700 mb-6 mx-4">
          <ArrowLeft className="h-5 w-5 mr-2" />
          Back
        </Link>
        <h2 className="text-center text-3xl font-extrabold text-gray-900">Verify Your OTP</h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          Enter the 4-digit code sent to your email.
        </p>
      </div>
      <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div className="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form className="space-y-6" onSubmit={handleSubmit}>
            <div>
              <label htmlFor="otp" className="block text-sm font-medium text-gray-700">
                OTP
              </label>
              <input
                id="otp"
                name="otp"
                type="text"
                inputMode="numeric"
                pattern="\d{4}"
                maxLength={4}
                required
                value={otp}
                onChange={handleChange}
                className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                placeholder="Enter 4-digit code"
              />
            </div>
            <div>
              <button
                type="submit"
                className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                disabled={otp.length !== 4}
              >
                Verify OTP
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
}