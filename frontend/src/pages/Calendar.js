import React from 'react';
import Calendartable from '../components/Calendartable';
import { useEffect } from 'react';
import Navbar from '../components/Navbar';
import Sidebar from '../components/Sidebar';

const Calendar = () => {
    useEffect(() => {
      const checkAuth = async () => {
        try {
          const session = localStorage.getItem("session");
          if (!session) {
            throw new Error("Not authenticated");
          }
        } catch (err) {
          window.location.href = "/login";
        }
      };
      checkAuth();
    }, []);

    return (
        <div>
            <Calendartable />
        </div>
    );
}

export default Calendar;
