import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { ArrowLeft, ArrowRight, UserCheck, Rocket } from 'lucide-react';
import AccountTypeSelector from './registration/AccountTypeSelector';
import ProgressIndicator from './registration/ProgressIndicator';
import StudentForm from './registration/StudentForm';
import SchoolAdminForm from './registration/SchoolAdminForm';
import SuccessModal from './registration/SuccessModal';
import type { AccountType, StudentFormData, SchoolAdminFormData, RegistrationData } from '../types/registration';

const nigerianStates = [
  'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
  'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe', 'Imo',
  'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa',
  'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba',
  'Yobe', 'Zamfara'
];

export default function Registration() {
  const [accountType, setAccountType] = useState<AccountType>(null);
  const [currentStep, setCurrentStep] = useState(1);
  const [agreeToTerms, setAgreeToTerms] = useState(false);
  const [showSuccessModal, setShowSuccessModal] = useState(false);
  const [registrationData, setRegistrationData] = useState<RegistrationData>({});

  const [studentFormData, setStudentFormData] = useState<StudentFormData>({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
  });

  const [schoolAdminFormData, setSchoolAdminFormData] = useState<SchoolAdminFormData>({
    adminName: '',
    adminPhone: '',
    adminEmail: '',
    schoolName: '',
    schoolPhone: '',
    schoolEmail: '',
    schoolState: '',
    schoolCity: '',
    schoolAddress: '',
    numberOfStudents: 0,
    adminPassword: '',
    adminPassword_confirmation: ''
  });

  const totalSteps = accountType === 'student' ? 3 : 5;

  const handleAccountTypeSelect = (type: AccountType) => {
    setAccountType(type);
    setCurrentStep(1);
  };

  const handleStudentFormChange = (field: keyof StudentFormData, value: string) => {
    setStudentFormData(prev => ({ ...prev, [field]: value }));
  };

  const handleSchoolAdminFormChange = (field: keyof SchoolAdminFormData, value: string | number) => {
    setSchoolAdminFormData(prev => ({ ...prev, [field]: value }));
  };

  const handleNextStep = (e: React.FormEvent) => {
    e.preventDefault();
    if (currentStep < totalSteps) {
      setCurrentStep(prev => prev + 1);
    }
  };

  const handlePreviousStep = () => {
    if (currentStep > 1) {
      setCurrentStep(prev => prev - 1);
    }
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    if (accountType === 'student') {
      console.log('Student registration:', studentFormData);
    } else {
      const totalAmount = schoolAdminFormData.numberOfStudents * 1000;
      setRegistrationData({
        admin_email: schoolAdminFormData.adminEmail,
        formatted_amount: `₦${totalAmount.toLocaleString()}.00`,
        school_name: schoolAdminFormData.schoolName,
        school_code: `SCH${Math.random().toString(36).substr(2, 6).toUpperCase()}`,
        number_of_students: schoolAdminFormData.numberOfStudents
      });
      setShowSuccessModal(true);
      console.log('School admin registration:', schoolAdminFormData);
    }
  };

  const handleBackToAccountType = () => {
    setAccountType(null);
    setCurrentStep(1);
    setAgreeToTerms(false);
  };

  return (
    <div className="min-h-screen flex items-center justify-center p-3 sm:p-4 bg-gray-100">
      <div className="w-full max-w-4xl">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="bg-white/90 backdrop-blur-sm rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 shadow-2xl border border-white/20"
        >
          <div className="text-center mb-6 sm:mb-8">
            <h1 className="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Create Your Account</h1>
            <p className="text-sm sm:text-base text-gray-600">Join thousands of students preparing for success!</p>
          </div>

          {!accountType && (
            <AccountTypeSelector onSelect={handleAccountTypeSelect} />
          )}

          {accountType && (
            <>
              <ProgressIndicator
                currentStep={currentStep}
                totalSteps={totalSteps}
                accountType={accountType}
              />

              <form onSubmit={currentStep === totalSteps ? handleSubmit : handleNextStep} className="space-y-4 sm:space-y-6">
                {accountType === 'student' ? (
                  <StudentForm
                    currentStep={currentStep}
                    formData={studentFormData}
                    onChange={handleStudentFormChange}
                  />
                ) : (
                  <SchoolAdminForm
                    currentStep={currentStep}
                    formData={schoolAdminFormData}
                    onChange={handleSchoolAdminFormChange}
                    states={nigerianStates}
                  />
                )}

                {currentStep === totalSteps && (
                  <motion.label
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    className="flex items-start space-x-3 cursor-pointer"
                  >
                    <input
                      type="checkbox"
                      checked={agreeToTerms}
                      onChange={(e) => setAgreeToTerms(e.target.checked)}
                      className="w-5 h-5 mt-0.5 text-blue-600 rounded focus:ring-blue-500"
                    />
                    <span className="text-xs sm:text-sm text-gray-600">
                      I agree to the <a href="/terms" className="text-blue-600 hover:text-blue-700 underline">Terms & Conditions</a> and <a href="/privacy" className="text-blue-600 hover:text-blue-700 underline">Privacy Policy</a>
                    </span>
                  </motion.label>
                )}

                <div className="flex items-center justify-between pt-4 sm:pt-6 border-t border-gray-200">
                  {currentStep > 1 ? (
                    <motion.button
                      type="button"
                      onClick={handlePreviousStep}
                      whileHover={{ scale: 1.05 }}
                      whileTap={{ scale: 0.95 }}
                      className="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-300 inline-flex items-center"
                    >
                      <ArrowLeft className="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                      Back
                    </motion.button>
                  ) : (
                    <motion.button
                      type="button"
                      onClick={handleBackToAccountType}
                      whileHover={{ scale: 1.05 }}
                      whileTap={{ scale: 0.95 }}
                      className="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-300 inline-flex items-center"
                    >
                      <ArrowLeft className="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                      Back
                    </motion.button>
                  )}

                  {currentStep === totalSteps ? (
                    <motion.button
                      type="submit"
                      disabled={!agreeToTerms}
                      whileHover={agreeToTerms ? { scale: 1.05 } : {}}
                      whileTap={agreeToTerms ? { scale: 0.95 } : {}}
                      className={`px-6 sm:px-8 py-3 sm:py-3.5 text-sm sm:text-base font-bold rounded-xl shadow-lg transition-all duration-300 inline-flex items-center ${
                        agreeToTerms
                          ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white hover:shadow-xl'
                          : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                      }`}
                    >
                      {accountType === 'student' ? (
                        <>
                          <UserCheck className="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                          Create Account
                        </>
                      ) : (
                        <>
                          <Rocket className="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                          Complete Registration
                        </>
                      )}
                    </motion.button>
                  ) : (
                    <motion.button
                      type="submit"
                      whileHover={{ scale: 1.05 }}
                      whileTap={{ scale: 0.95 }}
                      className="px-6 sm:px-8 py-3 sm:py-3.5 text-sm sm:text-base bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 inline-flex items-center"
                    >
                      Continue
                      <ArrowRight className="w-4 h-4 sm:w-5 sm:h-5 ml-2" />
                    </motion.button>
                  )}
                </div>
              </form>
            </>
          )}

          <div className="text-center mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-200">
            <p className="text-xs sm:text-sm text-gray-600">
              Already have an account?
              <a href="/login" className="text-blue-600 hover:text-blue-700 font-semibold ml-1">Sign In</a>
            </p>
          </div>
        </motion.div>
      </div>

      <SuccessModal
        isOpen={showSuccessModal}
        onClose={() => setShowSuccessModal(false)}
        registrationData={registrationData}
      />
    </div>
  );
}
