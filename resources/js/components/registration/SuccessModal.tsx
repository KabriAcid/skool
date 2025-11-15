import { motion, AnimatePresence } from 'framer-motion';
import { Home } from 'lucide-react';
import type { RegistrationData } from '../../types/registration';

interface SuccessModalProps {
  isOpen: boolean;
  onClose: () => void;
  registrationData: RegistrationData;
}

export default function SuccessModal({ isOpen, onClose, registrationData }: SuccessModalProps) {
  return (
    <AnimatePresence>
      {isOpen && (
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
          onClick={onClose}
        >
          <motion.div
            initial={{ opacity: 0, scale: 0.9 }}
            animate={{ opacity: 1, scale: 1 }}
            exit={{ opacity: 0, scale: 0.9 }}
            className="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 max-w-2xl w-full shadow-strong"
            onClick={(e) => e.stopPropagation()}
          >
            {/* Success Animation */}
            <div className="text-center mb-6">
              <div className="flex justify-center mb-4">
                <motion.div
                  initial={{ scale: 0 }}
                  animate={{ scale: 1 }}
                  transition={{ delay: 0.2, type: 'spring', stiffness: 200 }}
                  className="w-24 h-24 bg-success-100 rounded-full flex items-center justify-center"
                >
                  <motion.svg
                    initial={{ pathLength: 0 }}
                    animate={{ pathLength: 1 }}
                    transition={{ delay: 0.4, duration: 0.5 }}
                    className="w-16 h-16 text-success-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <motion.path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M5 13l4 4L19 7"
                    />
                  </motion.svg>
                </motion.div>
              </div>
              <h2 className="text-2xl sm:text-3xl font-bold text-spiritual-900 mb-2">Registration Successful! 🎉</h2>
              <p className="text-sm sm:text-base text-spiritual-600">Your school account has been created</p>
            </div>

            {/* Registration Details */}
            <div className="bg-primary-50 border border-primary-200 rounded-xl p-4 sm:p-6 mb-6">
              <h3 className="font-bold text-base sm:text-lg text-spiritual-900 mb-4">📧 What Happens Next?</h3>
              <div className="space-y-3 text-sm sm:text-base text-spiritual-700">
                <div className="flex items-start">
                  <span className="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">1</span>
                  <p>Check your email <strong>({registrationData.admin_email})</strong> for payment instructions</p>
                </div>
                <div className="flex items-start">
                  <span className="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">2</span>
                  <p>Make payment of <strong className="text-warning-700">{registrationData.formatted_amount}</strong> to the provided account</p>
                </div>
                <div className="flex items-start">
                  <span className="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">3</span>
                  <p>Your account will be activated within <strong>24 hours</strong> of payment confirmation</p>
                </div>
                <div className="flex items-start">
                  <span className="bg-primary-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">4</span>
                  <p>You'll receive an activation email with your dashboard access link</p>
                </div>
              </div>
            </div>

            {/* Account Details */}
            <div className="bg-secondary-50 border border-secondary-200 rounded-xl p-4 sm:p-6 mb-6">
              <h4 className="font-bold text-sm sm:text-base text-spiritual-900 mb-3">Your School Details:</h4>
              <div className="space-y-2 text-xs sm:text-sm">
                <div className="flex justify-between">
                  <span className="text-spiritual-600">School Name:</span>
                  <span className="font-medium">{registrationData.school_name}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-spiritual-600">School Code:</span>
                  <span className="font-mono font-bold text-primary-600">{registrationData.school_code}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-spiritual-600">Student Capacity:</span>
                  <span className="font-medium">{registrationData.number_of_students?.toLocaleString()} students</span>
                </div>
              </div>
            </div>

            {/* Action Button */}
            <button
              onClick={onClose}
              className="w-full bg-gradient-to-r from-primary-500 to-primary-600 text-white font-bold py-3 sm:py-4 px-6 rounded-xl shadow-medium hover:shadow-strong transition-all duration-300 hover:scale-105 active:scale-95 inline-flex items-center justify-center text-sm sm:text-base"
            >
              <Home className="w-5 h-5 mr-2" />
              Back to Home
            </button>

            <p className="text-center text-xs sm:text-sm text-spiritual-500 mt-4">
              Need help? Contact us at <a href="mailto:support@skool.ng" className="text-primary-600 hover:underline">support@skool.ng</a>
            </p>
          </motion.div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
