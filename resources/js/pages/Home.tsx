import React from 'react';
import { motion } from 'framer-motion';
import { BookOpen, Trophy, Users, Star, ArrowRight, Play } from 'lucide-react';
import Button from '../components/ui/Button';
import QuizCard from '../components/QuizCard';
import { Quiz } from '../types/quiz';

const Home: React.FC = () => {
  // Mock quiz data
  const featuredQuizzes: Quiz[] = [
    {
      id: '1',
      title: 'Surah Al-Fatiha',
      description: 'Test your knowledge of the opening chapter of the Quran',
      questions: [],
      timeLimit: 300,
      category: 'quran',
      difficulty: 'easy',
      totalPoints: 100,
    },
    {
      id: '2',
      title: 'Prophets of Islam',
      description: 'Learn about the messengers mentioned in the Quran',
      questions: [],
      timeLimit: 600,
      category: 'prophets',
      difficulty: 'medium',
      totalPoints: 200,
    },
    {
      id: '3',
      title: 'Islamic History',
      description: 'Explore the rich history of Islam and early Muslim community',
      questions: [],
      timeLimit: 900,
      category: 'islamic-history',
      difficulty: 'hard',
      totalPoints: 300,
    },
  ];

  const stats = [
    { icon: Users, label: 'Active Players', value: '10,000+', color: 'text-primary-600' },
    { icon: BookOpen, label: 'Quiz Questions', value: '5,000+', color: 'text-secondary-600' },
    { icon: Trophy, label: 'Completed Quizzes', value: '50,000+', color: 'text-success-600' },
    { icon: Star, label: 'Average Rating', value: '4.9/5', color: 'text-warning-600' },
  ];

  const handleStartQuiz = (quiz: Quiz) => {
    // Navigate to quiz page
    window.location.href = '/quiz';
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50">
      {/* Hero Section */}
      <section className="relative pt-20 pb-16 overflow-hidden">
        <div className="absolute inset-0 islamic-bg opacity-30" />
        
        <div className="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center space-y-8">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              className="space-y-4"
            >
              <h1 className="text-4xl md:text-6xl font-bold text-spiritual-900 leading-tight">
                Master Your
                <span className="text-gradient block">Quran Knowledge</span>
              </h1>
              <p className="text-lg md:text-xl text-spiritual-600 max-w-3xl mx-auto leading-relaxed">
                Enhance your understanding of the Holy Quran through interactive quizzes, 
                compete with fellow Muslims, and track your spiritual learning journey.
              </p>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
              className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4"
            >
              <Button variant="primary" size="lg" className="group">
                <Play className="w-5 h-5 mr-2" />
                Start Learning
                <ArrowRight className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" />
              </Button>
              <Button variant="secondary" size="lg">
                <Trophy className="w-5 h-5 mr-2" />
                View Leaderboard
              </Button>
            </motion.div>
          </div>

          {/* Hero Illustration */}
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 1, delay: 0.4 }}
            className="mt-16 relative"
          >
            <div className="w-full max-w-md mx-auto">
              <div className="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-strong">
                <div className="text-center space-y-4">
                  <div className="w-20 h-20 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl mx-auto flex items-center justify-center animate-bounce-gentle">
                    <BookOpen className="w-10 h-10 text-white" />
                  </div>
                  <h3 className="text-xl font-bold text-spiritual-900">Ready to Begin?</h3>
                  <p className="text-spiritual-600">Choose from hundreds of carefully crafted questions</p>
                  <div className="flex items-center justify-center space-x-2 text-sm text-spiritual-500">
                    <Star className="w-4 h-4 text-warning-500" />
                    <span>Trusted by 10,000+ learners</span>
                  </div>
                </div>
              </div>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-16 bg-white/50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
            {stats.map((stat, index) => (
              <motion.div
                key={stat.label}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
                className="text-center space-y-2"
              >
                <div className={`w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center ${stat.color}`}>
                  <stat.icon className="w-6 h-6" />
                </div>
                <div className="text-2xl font-bold text-spiritual-900">{stat.value}</div>
                <div className="text-sm text-spiritual-600">{stat.label}</div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Featured Quizzes */}
      <section className="py-16">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-spiritual-900 mb-4">
              Featured Quizzes
            </h2>
            <p className="text-lg text-spiritual-600 max-w-2xl mx-auto">
              Start your journey with these carefully selected quizzes designed to test and improve your Islamic knowledge.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {featuredQuizzes.map((quiz, index) => (
              <motion.div
                key={quiz.id}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
              >
                <QuizCard quiz={quiz} onStart={handleStartQuiz} />
              </motion.div>
            ))}
          </div>

          <motion.div
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            className="text-center mt-12"
          >
            <Button variant="outline" size="lg">
              View All Quizzes
              <ArrowRight className="w-5 h-5 ml-2" />
            </Button>
          </motion.div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 bg-gradient-to-r from-primary-600 to-secondary-600">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="space-y-6"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-white">
              Ready to Test Your Knowledge?
            </h2>
            <p className="text-xl text-primary-100 max-w-2xl mx-auto">
              Join thousands of Muslims worldwide in this beautiful journey of learning and spiritual growth.
            </p>
            <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
              <Button variant="secondary" size="lg" className="bg-white text-primary-600 hover:bg-primary-50">
                <Play className="w-5 h-5 mr-2" />
                Start Your First Quiz
              </Button>
              <Button variant="ghost" size="lg" className="text-white border-white hover:bg-white/10">
                Learn More
              </Button>
            </div>
          </motion.div>
        </div>
      </section>
    </div>
  );
};

export default Home;